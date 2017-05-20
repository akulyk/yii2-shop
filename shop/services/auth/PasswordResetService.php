<?php
/**
 * Created by PhpStorm.
 * User: akulyk
 * Date: 20.05.2017
 * Time: 21:39
 */

namespace shop\services\auth;


class PasswordResetService
{
    private $mailer;
    private $users;
    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }
    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);
        if (!$user->isActive()) {
            throw new \DomainException('User is not active.');
        }
        $user->requestPasswordReset();
        $this->users->save($user);
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }

}/* end of Service */
<?php


namespace Application;

class FrontendFeedbackTransaction
{
    private $feedbackGateway;
    private $notificationGateway;
    private $filesystem;
    private $usersGateway;

    public function __construct(FeedbackGateway $feedbackGateway, NotificationGateway $notificationGateway, UsersGateway $usersGateway, Filesystem $filesystem)
    {
        $this->feedbackGateway = $feedbackGateway;
        $this->notificationGateway = $notificationGateway;
        $this->filesystem = $filesystem;
        $this->usersGateway = $usersGateway;
    }

    public function submitFeedback($title, $description, $user, $attachmentFile)
    {
        $reciver= 'Admin';
        $notitype='Send Feedback';

        $attachment = $this->filesystem->upload($attachmentFile);
        $notireciver = 'Admin';
        $this->notificationGateway->insertUserReciverType($user, $notireciver, $notitype);
        $this->feedbackGateway->insertSenderReciverTitleFeedbackAttachment($user, $reciver, $title, $description, $attachment);
        return true;
  }

  public function getAllUsers()
  {
      return $this->usersGateway->findAll();
  }

  public function getAllByReciver($alogin)
  {
      return $this->feedbackGateway->findByReciver($alogin);
  }
}
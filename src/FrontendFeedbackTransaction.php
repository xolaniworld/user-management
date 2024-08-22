<?php


namespace Application;

class FrontendFeedbackTransaction
{
    private $feedbackGateway;
    private $notificationGateway;
    private $filesystem;
    private $usersGateway;

    public function __construct(FeedbackGateway $feedbackGateway, NotificationGateway $notificationGateway,
                                UsersGateway $usersGateway, Filesystem $filesystem)
    {
        $this->feedbackGateway = $feedbackGateway;
        $this->notificationGateway = $notificationGateway;
        $this->filesystem = $filesystem;
        $this->usersGateway = $usersGateway;
    }

    public function submitFeedback($title, $description, $user, $attachmentFile)
    {
        $receiver= 'Admin';
        $notitype='Send Feedback';

        $attachment = $this->filesystem->upload($attachmentFile);
        $notiReceiver = 'Admin';
        $this->notificationGateway->insertUserReceiverType($user, $notiReceiver, $notitype);
        $this->feedbackGateway->insertSenderReceiverTitleFeedbackAttachment($user, $receiver, $title, $description, $attachment);
        return true;
  }

  public function getAllUsers()
  {
      return $this->usersGateway->findAll();
  }

  public function getAllByReceiver($alogin)
  {
      return $this->feedbackGateway->findByReceiver($alogin);
  }
}
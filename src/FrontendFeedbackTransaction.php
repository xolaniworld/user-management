<?php


namespace Application;

class FrontendFeedbackTransaction
{
    private $feedbackGateway;
    private $notificationGateway;
    private $filesystem;

    public function __construct(FeedbackGateway $feedbackGateway, NotificationGateway $notificationGateway, Filesystem $filesystem)
    {
        $this->feedbackGateway = $feedbackGateway;
        $this->notificationGateway = $notificationGateway;
        $this->filesystem = $filesystem;
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
}
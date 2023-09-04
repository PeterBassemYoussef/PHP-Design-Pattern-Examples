<?php


interface NotificationStaretgy
{
    public function showNotification();
}


class AllNotifications implements NotificationStaretgy
{
    public function showNotification()
    {
        echo "Get All Notifications\n";
    }
}

class MentionedNotifications implements NotificationStaretgy
{
    public function showNotification()
    {
        echo "Get Mentioned Notifications\n";
    }
}

class MyPostsNotifications implements NotificationStaretgy
{
    public function showNotification()
    {
        echo "Get My Posts Notifications\n";
    }
}

class NotificationPage
{
    protected NotificationStaretgy $notificationObj;

    public function __construct()
    {
        // Default value
        $this->notificationObj = new AllNotifications();
    }

    public function setNotification(NotificationStaretgy $notification)
    {
        $this->notificationObj = $notification;
    }
    public function showNotification()
    {
        $this->notificationObj->showNotification();
    }
}


$allNotificaitons = new AllNotifications();
$mentionedNotifications = new MentionedNotifications();
$myPostsNotifications = new MyPostsNotifications();

$notificationPage = new NotificationPage();
$notificationPage->showNotification();

$notificationPage->setNotification($mentionedNotifications);
$notificationPage->showNotification();

$notificationPage->setNotification($allNotificaitons);
$notificationPage->showNotification();


$notificationPage->setNotification($myPostsNotifications);
$notificationPage->showNotification();

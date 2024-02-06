<?php

namespace App\Helpers;
use App\Http\Responses\Api;
use App\Mail\GeneralMail;
use App\Jobs\SendMailJob;
use Auth,DB;
use Illuminate\Support\Facades\Request;


class MailHelper
{
    /**
     * Send mail sign up
     * 
     * @param Transaction $transaction
     */
    public static function sendMail($data, $service)
    {
        //Send mail
        $dataMail['email']   = $data['t_email'];
        $dataMail['name']    = $data['t_name'];
        $dataMail['arrival_date']    = $data['arrival_date'];
        $dataMail['total_number']    = $data['t_total_number'];
        $dataMail['note']    = $data['t_note'];
        $dataMail['service']    = $service->s_name;
        $dataMail['subject'] = 'Thông báo đặt lịch hẹn.';
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
                ->setView('emails.email_success_transaction', $dataMail)
                ->setSubject($dataMail['subject'])
                ->setTo($dataMail['email']);
        dispatch(new SendMailJob($mailJob));
    }

    public static function sendMailNotification($data)
    {
        //Send mail
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.notification', $data)
            ->setSubject($data['subject'])
            ->setTo($data['email']);
        dispatch(new SendMailJob($mailJob));
    }

    public static function sendMailCouncil($data)
    {
        //Send mail
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.council', $data)
            ->setSubject($data['subject'])
            ->setTo($data['email']);
        dispatch(new SendMailJob($mailJob));
    }

    public static function sendMailRegisterTopic($data)
    {
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.register_topic', $data)
            ->setSubject($data['subject'])
            ->setTo($data['email']);
        dispatch(new SendMailJob($mailJob));
    }

    public static function sendMailOutline($data)
    {
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.outline', $data)
            ->setSubject($data['subject'])
            ->setTo($data['email']);
        dispatch(new SendMailJob($mailJob));
    }

    public static function sendMailCancel($data)
    {
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.cancel', $data)
            ->setSubject($data['subject'])
            ->setTo($data['email']);
        dispatch(new SendMailJob($mailJob));
    }
}

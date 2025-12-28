<?php

class Loan {
    private $idstudent;
    private $codebook;
    private $codecopy;
    private $idreview;
    private $refunddata;
    private $subscriptiondate;
    private $state;

    public function __construct(
        $idstudent,
        $codebook,
        $codecopy,
        $idreview,
        $refunddata,
        $subscriptiondate,
        $state
    ) {
        $this->idstudent = $idstudent;
        $this->codebook = $codebook;
        $this->codecopy = $codecopy;
        $this->idreview = $idreview;
        $this->refunddata = $refunddata;
        $this->subscriptiondate = $subscriptiondate;
        $this->state = $state;
    }

    public function getIdStudent() {
        return $this->idstudent;
    }

    public function getCodeBook() {
        return $this->codebook;
    }

    public function getCodeCopy() {
        return $this->codecopy;
    }

    public function getIdReview() {
        return $this->idreview;
    }

    public function getRefundData() {
        return $this->refunddata;
    }

    public function getSubscriptionDate() {
        return $this->subscriptiondate;
    }

    public function getState() {
        return $this->state;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
//echo "<pre>";
$userData = $this->session->userdata("user");
//var_dump($userData->name); exit;

?>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo base_url()."assets/layout/"?>css/template.css">
    <script type="application/javascript">
        window.baseurl ="<?php echo base_url()?>";
    </script>


</head>




<body>
<div id="container">
    <section id="memo">
        <div class="logo">
            <img SRC="<?php echo base_url()?>/assets/login/images/logo.png" />
        </div>

        <div class="company-info">
            <div>SUBHASH INFRAENGINEERS PVT. LTD.</div>

            <br />
            <span>Plot No.- 743 P , Sector- 38 , </span>
            <span>Gurugram , Haryana 122001</span>

            <br />

            <span>0124-2201616/17/18</span>
           <!-- <span>{company_email_web}</span> -->
        </div>

    </section>

    <section id="invoice-title-number">

        <span id="title">PURCHASE ORDER</span>
        <span id="number"><?php echo $podetail->po_no?></span>

    </section>

    <div class="clearfix"></div>

    <section id="client-info">
        <span>{bill_to_label}</span>
        <div>
            <span class="bold">{client_name}</span>
        </div>

        <div>
            <span>{client_address}</span>
        </div>

        <div>
            <span>{client_city_zip_state}</span>
        </div>

        <div>
            <span>{client_phone_fax}</span>
        </div>

        <div>
            <span>{client_email}</span>
        </div>

        <div>
            <span>{client_other}</span>
        </div>
    </section>

    <div class="clearfix"></div>

    <section id="items">

        <table cellpadding="0" cellspacing="0">

            <tr>
                <th width="20%">Part No.</th> <!-- Dummy cell for the row number and row commands -->
                <th width="30%">Part Name</th>
                <th width="25%">Quantity</th>
                <th width="25%">Price</th>

            </tr>

            <?php
            $total = 0;
            foreach ($transaction as $trans) :
            // var_dump($trans); exit;
            $total = $total + $trans->price;
            ?>

            <tr data-iterate="item">
                <td><?php echo $trans->part_no;?></td>
                <td><?php echo $trans->part_name;?></td>
                <td><?php echo $trans->quantity;?></td>
                <td><?php echo $trans->price;?></td>
            </tr>

            <?php endforeach;?>

        </table>

    </section>

    <section id="sums">

        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>Gross Total </th>
                <td><?php echo $total?></td>
            </tr>

            <tr data-iterate="tax">
                <th>GST</th>
                <td><?php $gst = $total * 18/100;
                $withGST = $total + $gst;
                echo $withGST;

                ?></td>
            </tr>

            <tr class="amount-total">
                <th>{amount_total_label}</th>
                <td>{amount_total}</td>
            </tr>

            <!-- You can use attribute data-hide-on-quote="true" to hide specific information on quotes.
                 For example Invoicebus doesn't need amount paid and amount due on quotes  -->
            <tr data-hide-on-quote="true">
                <th>{amount_paid_label}</th>
                <td>{amount_paid}</td>
            </tr>

            <tr data-hide-on-quote="true">
                <th>{amount_due_label}</th>
                <td>{amount_due}</td>
            </tr>

        </table>

        <div class="clearfix"></div>

    </section>

    <div class="clearfix"></div>

    <section id="invoice-info">
        <div>
            <span>{issue_date_label}</span> <span>{issue_date}</span>
        </div>
        <div>
            <span>{due_date_label}</span> <span>{due_date}</span>
        </div>

        <br />

        <div>
            <span>{currency_label}</span> <span>{currency}</span>
        </div>
        <div>
            <span>{po_number_label}</span> <span>{po_number}</span>
        </div>
        <div>
            <span>{net_term_label}</span> <span>{net_term}</span>
        </div>
    </section>

    <section id="terms">

        <div class="notes">{terms}</div>

        <br />

        <div class="payment-info">
            <div>{payment_info1}</div>
            <div>{payment_info2}</div>
            <div>{payment_info3}</div>
            <div>{payment_info4}</div>
            <div>{payment_info5}</div>
        </div>

    </section>

    <div class="clearfix"></div>

    <div class="thank-you">Thank You </div>

    <div class="clearfix"></div>
</div>


</body>



</html>

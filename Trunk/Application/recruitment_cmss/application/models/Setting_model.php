<?php

class Setting_model extends CI_model {

    private $role;

    function __construct() {
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
        $this->role = $this->session->userdata('role');
    }

    public function diff_in_month($from, $to) {
        $frmDate = date_create($from);
        $toDate = date_create($to);
        $difference = date_diff($toDate, $frmDate, true);
        $month = $difference->format("%a") / 30;
        return $month;
    }

    /**
     * 	Generate random registration_no 
     */
    public function rand_number($length) {
        $chars = "0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function settings($data, $op, $stage = null) {
        //print_r($op);die();
        switch ($op) {
            case 'GET_USER_DETAILS':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('user_master.user_code,user_master.employee_name', 'user_master.user_name', 'role_master.role_name');
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }


                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('user_master');
                $this->db->select("user_master.user_code,user_master.employee_name,user_master.user_name,user_master.password,user_master.role,role_master.role_name,user_master.image_file_name");
                $this->db->join('role_master', 'role_master.role_code=user_master.role', 'left');
                $this->db->order_by('user_master.employee_name', 'ASC');
                $res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('user_master');
                $this->db->select("user_master.user_code,user_master.employee_name,user_master.user_name,user_master.password,user_master.role,role_master.role_name,user_master.image_file_name");
                $this->db->join('role_master', 'role_master.role_code=user_master.role', 'left');
                $this->db->order_by('user_master.employee_name', 'ASC');
                $res1 = $this->db->get();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;


                break;

            case 'GET_ROLE_MASTER':
                $this->db->from('role_master');
                $this->db->select('role_code,role_name');
                $res = $this->db->get();
                return $res->result_array();
                break;

            case 'ADD_USER':
                //print_r ($data['adm_emp_name']);die();
                $new_data = array(
                    'user_code' => $data['adm_user_name'],
                    'employee_name' => $data['adm_emp_name'],
                    'user_name' => $data['adm_user_name'],
                    'password' => $data['adm_password'],
                    'role' => $data['adm_role'],
                    'image_file_name' => 'defult.png',
                    'institute_code' => 'DSTHD',
                    'category' => 'JGTS',
                    'sub_category' => 'JJKR',
                    'created_by' => $this->session->userdata('user_id'),
                    'created_on' => 'NOW()',
                    'updated_by' => $this->session->userdata('user_id'),
                    'updated_on' => 'NOW()',
                    'record_status' => 1
                );
                //print_r($new_data);die();
                if ($this->db->insert('user_master', $new_data))
                    return array('status' => true, 'msg' => OP_SUCCESS);
                else {

                    return array('status' => false, 'msg' => $this->db->_error_message());
                }
                break;
            case 'UPDATE_USER':
                $new_data = array(
                    'employee_name' => $data['user_code'],
                    'password' => $data['adm_password'],
                    'role' => $data['adm_role'],
                    'image_file_name' => 'defult.png',
                    'institute_code' => 'DSTHD',
                    'category' => 'JGTS',
                    'sub_category' => 'JJKR',
                    'updated_by' => $this->session->userdata('user_id'),
                    'updated_on' => 'NOW()',
                    'record_status' => 1
                );
                //print_r($new_data);die();
                $this->db->where('user_code', $data['user_code']);
                $this->db->update('user_master', $new_data);
                if ($this->db->affected_rows())
                    return array('status' => true, 'msg' => OP_SUCCESS);
                else {

                    return array('status' => false, 'msg' => $this->db->_error_message());
                }

                break;
            case 'CHECK_CONSUMER':
                //print_r($data['cons_id']);die();
                $this->db->from('consumer_master');
                $this->db->where('customer_no', $data['cons_id']);
                $this->db->where('record_status', 1);
                $res = $this->db->get();
                $query = $res->result_array();
                return $query;
                break;
            case 'GET_ALL_SCHEME':
                $this->db->from('scheme_master');
                $this->db->where('record_status', 1);
                $res = $this->db->get();
                return $res->result_array();
                break;
            case 'GET_ALL_ITEM':
                $this->db->select('product_id,product_name');
                $this->db->from('product_master');
                $this->db->where('record_status', 1);
                $res = $this->db->get();
                return $res->result_array();
                break;

            case 'GET_ITEM_PRICE':
                $this->db->from('product_master');
                $this->db->where('product_id', $data['item_id']);
                $this->db->where('record_status', 1);
                $res = $this->db->get();
                return $res->result_array();
                break;
            case 'GET_ORDER_CHECK_LIST':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('user_master.user_code', 'user_master.employee_name', 'user_master.user_name', 'role_master.role_name');
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }


                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('user_master');
                $this->db->select("user_master.user_code,user_master.employee_name,user_master.user_name,user_master.password,user_master.role");
                $this->db->join('role_master', 'role_master.role_code=user_master.role', 'left');
                $this->db->order_by('user_master.employee_name', 'ASC');
                $res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('user_master');
                $this->db->select("user_master.user_code,user_master.employee_name,user_master.user_name,user_master.password,user_master.role");
                $this->db->join('role_master', 'role_master.role_code=user_master.role', 'left');
                $this->db->order_by('user_master.employee_name', 'ASC');
                $res1 = $this->db->get();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;

                break;
            case 'CONS_ITEM_LIST':
                //print_r($data['scheme_id']);die();
                if ($data['stove_id'] == '') {
                    $this->db->from('scheme_product a');
                    $this->db->select('b.product_name,b.hsn_no,b.unit_in,default_qty,b.price,(default_qty*b.price) AS total,b.cgst,
                                    ROUND(((default_qty*b.price*b.cgst)/100),2) AS cgst_amt,b.sgst,
                                    ROUND(((default_qty*b.price*b.`sgst`)/100),2) AS sgst_amt,((default_qty*b.price)+
                                    ROUND(((default_qty*b.price*b.`cgst`)/100),2)+
                                    ROUND(((default_qty*b.price*b.`sgst`)/100),2)) AS total_amount,a.scheme_id,a.product_id');
                    $this->db->join('product_master b', 'a.product_id=b.product_id');
                    $this->db->where('scheme_id', $data['scheme_id']);
                    $this->db->group_by('a.sl_no');
                    $res = $this->db->get();
                    $qry = $res->result_array();
                    $output = array("aaData" => array());
                    $slno = 1;
                    foreach ($qry as $aRow) {
                        $row[0] = $slno;
                        $row['sl_no'] = $slno;
                        $i = 1;
                        foreach ($aRow as $key => $value) {
                            $row[$i] = $value;
                            $row[$key] = $value;
                            $i++;
                        }

                        $output['aaData'][] = $row;
                        $slno++;
                        unset($row);
                    }
                    return $output;
                } else {
                    $item_Qry = $this->db->query("SELECT `b`.`product_name`, `b`.`hsn_no`, `b`.`unit_in`, `default_qty`, `b`.`price`, (default_qty*b.price) AS total, `b`.`cgst`, 
                    ROUND(((default_qty*b.price*b.cgst)/100), 2) AS cgst_amt, `b`.`sgst`, 
                    ROUND(((default_qty*b.price*b.`sgst`)/100), 2) AS sgst_amt, ((default_qty*b.price)+
                    ROUND(((default_qty*b.price*b.`cgst`)/100), 2)+
                    ROUND(((default_qty*b.price*b.`sgst`)/100), 2)) AS total_amount, `a`.`scheme_id`, `a`.`product_id`
                    FROM (
                    SELECT * FROM scheme_product WHERE `scheme_id` = ? AND sl_no!=1
                    UNION
                    SELECT * FROM scheme_product WHERE `scheme_id` = ? AND product_id=?) `a`
                    JOIN product_master b ON a.product_id =`b`.`product_id`", array($data['scheme_id'], $data['scheme_id'], $data['stove_id']));

                    $qry = $item_Qry->result_array();
                    $output = array("aaData" => array());
                    $slno = 1;
                    foreach ($qry as $aRow) {
                        $row[0] = $slno;
                        $row['sl_no'] = $slno;
                        $i = 1;
                        foreach ($aRow as $key => $value) {
                            $row[$i] = $value;
                            $row[$key] = $value;
                            $i++;
                        }

                        $output['aaData'][] = $row;
                        $slno++;
                        unset($row);
                    }
                    return $output;
                }
                break;
            case 'CONS_ITEM_LIST_B2B':
                //print_r($data['scheme_id']);die();                
                $this->db->from('scheme_product a');
                $this->db->select('b.product_name,b.hsn_no,b.unit_in,default_qty,b.price,(default_qty*b.price) AS total,b.cgst,
                                ROUND(((default_qty*b.price*b.cgst)/100),2) AS cgst_amt,b.sgst,
                                ROUND(((default_qty*b.price*b.`sgst`)/100),2) AS sgst_amt,((default_qty*b.price)+
                                ROUND(((default_qty*b.price*b.`cgst`)/100),2)+
                                ROUND(((default_qty*b.price*b.`sgst`)/100),2)) AS total_amount,a.scheme_id,a.product_id');
                $this->db->join('product_master b', 'a.product_id=b.product_id');
                $this->db->where('scheme_id', $data['scheme_id']);
                $this->db->group_by('a.sl_no');
                $res = $this->db->get();
                $qry = $res->result_array();
                $output = array("aaData" => array());
                $slno = 1;
                foreach ($qry as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {
                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;

                break;
            case 'INSERT_ITEM_LIST':
                //print_r($data['tot_amt']);die();
                $Con_Qry = '';
                $id_Qry = $this->db->query("SELECT CASE  p_id 
                    WHEN 1 THEN CONCAT('OB000',p_val) 
                    WHEN 2 THEN CONCAT('OB00',p_val) 
                    WHEN 3 THEN CONCAT('OB0',p_val)
                    WHEN 4 THEN CONCAT('OB',p_val)
                    WHEN 5 THEN CONCAT('OB',p_val) END AS order_id FROM (
                    SELECT LENGTH(IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1) AS p_id ,
                    IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1 AS p_val 
                    FROM `order_booking_trans`) a");
                $result = $id_Qry->result_array();
                $row1 = array_shift($result);

                $memo_Qry = $this->db->query("SELECT CASE  p_id 
                        WHEN 1 THEN CONCAT('MO000',p_val) 
                        WHEN 2 THEN CONCAT('MO00',p_val) 
                        WHEN 3 THEN CONCAT('MO0',p_val)
                        WHEN 4 THEN CONCAT('MO',p_val)
                        WHEN 5 THEN CONCAT('MO',p_val) END AS memo_id FROM (
                        SELECT LENGTH(IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1) AS p_id ,
                        IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1 AS p_val 
                        FROM `order_booking_trans`) a");
                $result = $memo_Qry->result_array();
                $row2 = array_shift($result);

                if ($data['op_type'] == 1) {
                    $Con_Qry = $this->db->query("SELECT CASE  p_id 
                        WHEN 1 THEN CONCAT('00000',p_val) 
                        WHEN 2 THEN CONCAT('0000',p_val) 
                        WHEN 3 THEN CONCAT('000',p_val)
                        WHEN 4 THEN CONCAT('00',p_val)
                        WHEN 5 THEN CONCAT('0',p_val) 
                        ELSE p_val END AS cons_id FROM (
                        SELECT LENGTH(IFNULL(MAX(CAST(consumer_id AS SIGNED )),0)+1) AS p_id ,
                        IFNULL(MAX(CAST(consumer_id AS SIGNED )),0)+1 AS p_val 
                        FROM consumer_master) a");
                    $result = $Con_Qry->result_array();
                    $row_con = array_shift($result);

                    $consumer_master_data = array(
                        'consumer_id' => $row_con['cons_id'],
                        'customer_no' => $row_con['cons_id'],
                        'consumer_name' => $data['txt_cons_name'],
                        'consumer_address_line1' => $data['txt_address'],
                        'district_code' => $data['dd_dist'],
                        'state_code' => $data['dd_state'],
                        'pin_no' => $data['txt_pin'],
                        'contact_no' => $data['txt_mob'],
                        'created_by' => $this->session->userdata('user_id'),
                        'created_on' => date('Y-m-d H:i:s', now()),
                        'updated_by' => $this->session->userdata('user_id'),
                        'updated_on' => date('Y-m-d H:i:s', now()),
                        'record_status' => 1
                    );
                    // print_r($order_book_trans_data);die();
                    $insert_consumer_master_data = $this->db->insert('consumer_master', $consumer_master_data);
                }
                $con_id = '';
                if ($data['op_type'] == 1) {
                    $con_id = $row_con['cons_id'];
                } else {
                    $con_id = $data['cons_id'];
                }
                $order_book_trans_data = array(
                    'order_book_id' => $row1['order_id'],
                    'memo_no' => $row2['memo_id'],
                    'memo_date' => date('Y-m-d', strtotime($data['date'])),
                    'consumer_id' => $con_id,
                    'paymeny_type' => $data['dd_payment'],
                    'order_type' => 'NEW',
                    'total_item_amt' => 'DSTHD',
                    'total_amount' => $data['tot_amt'],
                    'balance' => '0',
                    'scheme_id' => $data['arr'][0]['scheme_id'],
                    'order_status' => 'BOOK',
                    'recover_from_customer' => $data['txt_consol_amt'],
                    'cyl' => $data['txt_security_cylinder'],
                    'reg' => $data['txt_reg'],
                    'refill_amt' => $data['txt_refill_amt'],
                    'tot_amt' => $data['txt_total_amt'],
                    'pmuy_loan' => $data['txt_pmuy_loan'],
                    'rcv_frm_customer' => $data['txt_rcv_cons'],
                    'created_by' => $this->session->userdata('user_id'),
                    'created_on' => date('Y-m-d H:i:s', now()),
                    'updated_by' => $this->session->userdata('user_id'),
                    'updated_on' => date('Y-m-d H:i:s', now()),
                    'record_status' => 1
                );
                // print_r($order_book_trans_data);die();
                $insert_order_book_trans_data = $this->db->insert('order_booking_trans', $order_book_trans_data);
                if ($insert_order_book_trans_data) {
                    $valuearray = $data['arr'];
                    //echo sizeof($valuearray);
                    for ($i = 0; $i < sizeof($valuearray); $i++) {
                        $order_book_details_data = array(
                            'order_book_id' => $row1['order_id'],
                            'item_sl_no' => $valuearray[$i][0],
                            'memo_no' => $row2['memo_id'],
                            'item_id' => $valuearray[$i]['product_id'],
                            'item_name' => $valuearray[$i]['product_name'],
                            'hsn_no' => $valuearray[$i]['hsn_no'],
                            'unit' => $valuearray[$i]['unit_in'],
                            'quantity' => $valuearray[$i]['default_qty'],
                            'price' => $valuearray[$i]['price'],
                            'total' => $valuearray[$i]['total'],
                            'cgst_rate' => $valuearray[$i]['cgst'],
                            'cgst_amt' => $valuearray[$i]['cgst_amt'],
                            'sgst_rate' => $valuearray[$i]['sgst'],
                            'sgst_amt' => $valuearray[$i]['sgst_amt'],
                            'total_price' => $valuearray[$i]['total_amount'],
                            'created_by' => $this->session->userdata('user_id'),
                            'created_on' => date('Y-m-d H:i:s', now()),
                            'updated_by' => $this->session->userdata('user_id'),
                            'updated_on' => date('Y-m-d H:i:s', now()),
                            'record_status' => 1
                        );
                        //print_r( $order_book_details_data);
                        $insert_order_book_details_data = $this->db->insert('order_booking_details', $order_book_details_data);
                    }
                    return array('status' => TRUE, 'msg' => 'success', 'ord_id' => $row1['order_id']);
                } else {
                    return array('status' => false, 'msg' => $this->db->_error_message());
                }
                break;
            case 'GET_ITEM_NO':
                $id_Qry = $this->db->query("SELECT @row := @row + 1 AS qty FROM 
                (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t,
                (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t2,
                (SELECT @row:=0)t5");
                $result = $id_Qry->result_array();
                return $result;
                break;
            case 'INSERT_ITEM_LISTB2B':

                $id_Qry = $this->db->query("SELECT CASE  p_id 
                    WHEN 1 THEN CONCAT('OB000',p_val) 
                    WHEN 2 THEN CONCAT('OB00',p_val) 
                    WHEN 3 THEN CONCAT('OB0',p_val)
                    WHEN 4 THEN CONCAT('OB',p_val)
                    WHEN 5 THEN CONCAT('OB',p_val) END AS order_id FROM (
                    SELECT LENGTH(IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1) AS p_id ,
                    IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1 AS p_val 
                    FROM `order_booking_trans`) a");
                $result = $id_Qry->result_array();
                $row1 = array_shift($result);

                $memo_Qry = $this->db->query("SELECT CASE  p_id 
                    WHEN 1 THEN CONCAT('MO000',p_val) 
                    WHEN 2 THEN CONCAT('MO00',p_val) 
                    WHEN 3 THEN CONCAT('MO0',p_val)
                    WHEN 4 THEN CONCAT('MO',p_val)
                    WHEN 5 THEN CONCAT('MO',p_val) END AS memo_id FROM (
                    SELECT LENGTH(IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1) AS p_id ,
                    IFNULL(MAX(CAST(SUBSTRING(order_book_id,3) AS SIGNED )),0)+1 AS p_val 
                    FROM `order_booking_trans`) a");
                $result = $memo_Qry->result_array();
                $row2 = array_shift($result);

                $order_book_trans_data = array(
                    'order_book_id' => $row1['order_id'],
                    'memo_no' => $row2['memo_id'],
                    'memo_date' => date('Y-m-d', strtotime($data['date'])),
                    'consumer_id' => $data['txt_cons_id'],
                    'paymeny_type' => $data['dd_payment'],
                    'order_type' => 'NEW',
                    'total_item_amt' => 'DSTHD',
                    'total_amount' => $data['tot_amt'],
                    'balance' => '0',
                    'scheme_id' => $data['arr'][0]['scheme_id'],
                    'order_status' => 'BOOK',
                    'created_by' => $this->session->userdata('user_id'),
                    'created_on' => date('Y-m-d H:i:s', now()),
                    'updated_by' => $this->session->userdata('user_id'),
                    'updated_on' => date('Y-m-d H:i:s', now()),
                    'record_status' => 1
                );
                // print_r($order_book_trans_data);die();
                $insert_order_book_trans_data = $this->db->insert('order_booking_trans', $order_book_trans_data);
                if ($insert_order_book_trans_data) {
                    $valuearray = $data['arr'];
                    //echo sizeof($valuearray);
                    for ($i = 0; $i < sizeof($valuearray); $i++) {
                        $order_book_details_data = array(
                            'order_book_id' => $row1['order_id'],
                            'item_sl_no' => $valuearray[$i][0],
                            'memo_no' => $row2['memo_id'],
                            'item_id' => $valuearray[$i]['product_id'],
                            'item_name' => $valuearray[$i]['product_name'],
                            'hsn_no' => $valuearray[$i]['hsn_no'],
                            'unit' => $valuearray[$i]['unit_in'],
                            'quantity' => $valuearray[$i]['default_qty'],
                            'price' => $valuearray[$i]['price'],
                            'total' => $valuearray[$i]['total'],
                            'cgst_rate' => $valuearray[$i]['cgst'],
                            'cgst_amt' => $valuearray[$i]['cgst_amt'],
                            'sgst_rate' => $valuearray[$i]['sgst'],
                            'sgst_amt' => $valuearray[$i]['sgst_amt'],
                            'total_price' => $valuearray[$i]['total_amount'],
                            'created_by' => $this->session->userdata('user_id'),
                            'created_on' => date('Y-m-d H:i:s', now()),
                            'updated_by' => $this->session->userdata('user_id'),
                            'updated_on' => date('Y-m-d H:i:s', now()),
                            'record_status' => 1
                        );
                        //print_r( $order_book_details_data);
                        $insert_order_book_details_data = $this->db->insert('order_booking_details', $order_book_details_data);
                    }
                    return array('status' => TRUE, 'msg' => 'success', 'ord_id' => $row1['order_id']);
                } else {
                    return array('status' => false, 'msg' => $this->db->_error_message());
                }

                break;
            case 'GET_ORDER_DATA_PDF':
                $this->db->from('order_booking_details');
                $this->db->where('order_book_id', $data);
                $res = $this->db->get();
                return $res->result_array();
                break;
            case 'GET_MRP_DETAILS':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('product_id', 'product_name', 'price', 'cgst', 'sgst');
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }


                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('product_master');
                $this->db->where('record_status', 1);
                $this->db->select("product_id,product_name,hsn_no,price,cgst,sgst");
                $res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('product_master');
                $this->db->where('record_status', 1);
                $this->db->select("product_id,product_name,hsn_no,price,cgst,sgst");
                $res1 = $this->db->get();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;


                break;

            case 'DELETE_PROD_ID'://delete product mrp

                $this->db->where('product_id', $data['prod_id']);
                $res = $this->db->get('product_master');
                $qry = $res->result_array();
                $row = array_shift($qry);
                $new_data = array(
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'hsn_no' => $row['hsn_no'],
                    'price' => $row['price'],
                    'unit_in' => $row['unit_in'],
                    'sub_brand_id' => $row['sub_brand_id'],
                    'cgst' => $row['cgst'],
                    'sgst' => $row['sgst'],
                    'created_by' => $row['created_by'],
                    'created_on' => $row['created_on'],
                    'updated_by' => $row['updated_by'],
                    'updated_on' => $row['updated_on'],
                    'record_status' => 1
                );
                $this->db->insert('product_master_history', $new_data);
                if ($this->db->affected_rows()) {
                    $up_data = array('record_status' => 0);
                    $this->db->where('product_id', $data['prod_id']);
                    $this->db->update('product_master', $up_data);
                    if ($this->db->affected_rows()) {
                        return array('status' => true, 'msg' => OP_SUCCESS);
                    } else {
                        return array('status' => false, 'msg' => $this->db->_error_message());
                    }
                } else {
                    return array('status' => false, 'msg' => $this->db->_error_message());
                }
                break;
            case 'PRODUCT_MRP'://product mrp change
                if ($this->input->post('op') == 'edit') {
                    $this->db->where('product_id', $data['prod_id']);
                    $res = $this->db->get('product_master');
                    $qry = $res->result_array();
                    $row = array_shift($qry);
                    $new_data = array(
                        'product_id' => $row['product_id'],
                        'product_name' => $row['product_name'],
                        'hsn_no' => $row['hsn_no'],
                        'price' => $row['price'],
                        'unit_in' => $row['unit_in'],
                        'sub_brand_id' => $row['sub_brand_id'],
                        'cgst' => $row['cgst'],
                        'sgst' => $row['sgst'],
                        'created_by' => $row['created_by'],
                        'created_on' => $row['created_on'],
                        'updated_by' => $row['updated_by'],
                        'updated_on' => $row['updated_on'],
                        'record_status' => 1
                    );
                    $this->db->insert('product_master_history', $new_data);
                    if ($this->db->affected_rows()) {
                        $up_data = array(
                            'product_name' => $data['adm_prdct_name'],
                            'price' => $data['adm_price'],
                            'hsn_no' => $data['adm_hsn'],
                            'cgst' => $data['adm_cgst'],
                            'sgst' => $data['adm_sgst'],
                            'updated_by' => $this->session->userdata('user_id'),
                            'updated_on' => 'NOW()',
                            'record_status' => 1
                        );
                        $this->db->where('product_id', $data['prod_id']);
                        $qry_update = $this->db->update('product_master', $up_data);
                        if ($this->db->affected_rows() || $qry_update) {
                            return array('status' => true, 'msg' => OP_SUCCESS);
                        } else {
                            return array('status' => false, 'msg' => $this->db->_error_message());
                        }
                    } else {
                        return array('status' => false, 'msg' => $this->db->_error_message());
                    }
                } elseif ($this->input->post('op') == 'add') {
                    $query = $this->db->query("SELECT
								CASE  p_id 
								 WHEN 1 THEN CONCAT('P00',p_val) 
								WHEN 2 THEN CONCAT('P0',p_val)
								WHEN 3 THEN CONCAT('P',p_val)
								WHEN 4 THEN CONCAT('P',p_val)
								WHEN 5 THEN CONCAT('P',p_val)
								END AS prod_id FROM (
								 SELECT LENGTH(IFNULL(MAX(CAST(SUBSTRING(product_id,2) AS SIGNED )),0)+1) AS p_id ,IFNULL(MAX(CAST(SUBSTRING(product_id,2) AS SIGNED )),0)+1 AS p_val 
								 FROM product_master) a");
                    $result = $query->result_array();
                    $row1 = array_shift($result);
                    $new_data = array(
                        'product_id' => $row1['prod_id'],
                        'product_name' => $data['adm_prdct_name'],
                        'hsn_no' => $data['adm_hsn'],
                        'unit_in' => 'PC',
                        'sub_brand_id' => 'SB001',
                        'price' => $data['adm_price'],
                        'cgst' => $data['adm_cgst'],
                        'sgst' => $data['adm_sgst'],
                        'created_by' => $this->session->userdata('user_id'),
                        'created_on' => 'NOW()',
                        'record_status' => 1
                    );
                    $this->db->insert('product_master', $new_data);
                    if ($this->db->affected_rows()) {
                        return array('status' => true, 'msg' => OP_SUCCESS);
                    } else {
                        return array('status' => false, 'msg' => $this->db->_error_message());
                    }
                } else {
                    return array('status' => false, 'msg' => $this->db->_error_message());
                }
                break;
            case 'GET_PRODUCT':
                $this->db->select('product_id,product_name');
                $this->db->where('record_status', 1);
                $res = $this->db->get('product_master');
                $qry = $res->result_array();
                $slno = 1;
                foreach ($qry as $aRow) {
                    $output[] = $aRow;
                    unset($aRow);
                }
                return $output;
                break;
            case 'GET_vendor':
                $this->db->select('vendor_id,vendor_name');
                $this->db->where('record_status', 1);
                $res = $this->db->get('vendor_master');
                $qry = $res->result_array();
                $slno = 1;
                foreach ($qry as $aRow) {
                    $output[] = $aRow;
                    unset($aRow);
                }
                return $output;
                break;
            case 'STOCK_ENTRY':
                if ($data['stock_id'] == '') {
                    $query = $this->db->query("SELECT
						CASE  p_id 
						WHEN 1 THEN CONCAT('SD0000',p_val) 
						WHEN 2 THEN CONCAT('SD000',p_val)
						WHEN 3 THEN CONCAT('SD00',p_val)
						WHEN 4 THEN CONCAT('SD0',p_val)
						WHEN 5 THEN CONCAT('SD',p_val)
						WHEN 6 THEN CONCAT('SD',p_val)
						WHEN 7 THEN CONCAT('SD',p_val)
						END AS stock_received_id FROM (
						SELECT LENGTH(IFNULL(MAX(CAST(SUBSTRING(stock_received_id,3) AS SIGNED )),0)+1) AS p_id ,IFNULL(MAX(CAST(SUBSTRING(stock_received_id,3) AS SIGNED )),0)+1 AS p_val 
						FROM stock_details) a");
                    $result = $query->result_array();
                    $row1 = array_shift($result);
                    $stock_data = array(
                        'stock_received_id' => $row1['stock_received_id'],
                        'stock_received_date' => '',
                        'vendor_id' => $data['txtdistribter'],
                        'receipt_no' => 'PC',
                        'vehicle_no' => $data['txtvehicle_no'],
                        'driver_name' => '',
                        'entry_date_time' => $data['txtdate'],
                        'billed_amount' => '',
                        'bill_date' => '',
                        'created_by' => $this->session->userdata('user_id'),
                        'created_on' => 'NOW()',
                        'record_status' => 1
                    );
                    $this->db->insert('stock_master', $stock_data);
                } else {
                    $row1['stock_received_id'] = $data['stock_id'];
                }

                if ($data['op'] == 'add') {
                    $qry = $this->db->query("SELECT CASE sl_no WHEN 0 THEN 1 ELSE sl_no+1 END AS sl_no1 
							FROM (SELECT COUNT(sl_no) AS sl_no FROM stock_details WHERE stock_received_id = '" . $row1['stock_received_id'] . "') a");
                    $Sresult = $qry->result_array();
                    $row2 = array_shift($Sresult);
                    $stock_product = array(
                        'stock_received_id' => $row1['stock_received_id'],
                        'product_id' => $data['cmbprodlist'],
                        'product_quantity' => $data['txtquntity'],
                        'MRP' => '',
                        'sl_no' => $row2['sl_no1'],
                        'price' => $data['txtprice'],
                        'cgst' => $data['txtcgst'],
                        'sgst' => $data['txtsgst'],
                        'created_by' => $this->session->userdata('user_id'),
                        'created_on' => 'NOW()',
                        'record_status' => 1
                    );
                    $this->db->insert('stock_details', $stock_product);
                } else {
                    $stock_product = array(
                        'product_id' => $data['cmbprodlist'],
                        'product_quantity' => $data['txtquntity'],
                        'MRP' => '',
                        'price' => $data['txtprice'],
                        'cgst' => $data['txtcgst'],
                        'sgst' => $data['txtsgst'],
                        'created_by' => $this->session->userdata('user_id'),
                        'created_on' => 'NOW()',
                        'record_status' => 1
                    );
                    $this->db->where('stock_received_id', $data['stock_id']);
                    $this->db->where('sl_no', $data['stock_slno']);
                    $this->db->update('stock_details', $stock_product);
                }

                $output = $row1['stock_received_id'];
                return $output;
                break;
            case 'STOCK_ENTRY_DELETE'://delete stock entry
                $this->db->where('sl_no', $data['stck_slno']);
                $this->db->where('stock_received_id', $data['stock_received_id']);
                $exicute = $this->db->delete('stock_details');
                if ($exicute) {
                    return array('status' => true, 'msg' => OP_SUCCESS);
                } else {
                    return array('status' => false, 'msg' => $this->db->_error_message());
                }
                break;
            case 'GET_STOCK_DETAILS':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('pm.product_name', 'sd.price', 'sd.cgst', 'sd.sgst');
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }


                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('stock_details sd');
                $this->db->where('sd.record_status', 1);
                $this->db->where('sd.stock_received_id', $data['stock_rcvd_id']);
                $this->db->select("pm.product_name,sd.product_id,sd.sl_no,sd.product_quantity,sd.price,sd.cgst,sd.sgst");
                $this->db->join('product_master pm', 'sd.product_id = pm.product_id', 'inner');
                $res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('stock_details sd');
                $this->db->where('sd.record_status', 1);
                $this->db->where('sd.stock_received_id', $data['stock_rcvd_id']);
                $this->db->select("pm.product_name,sd.product_id,sd.sl_no,sd.product_quantity,sd.price,sd.cgst,sd.sgst");
                $this->db->join('product_master pm', 'sd.product_id = pm.product_id', 'inner');
                $res1 = $this->db->get();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;


                break;
            case 'GET_ALL_ORDER_LIST':
                $this->db->select('order_book_id,memo_no,consumer_name,paymeny_type,order_type,total_amount');
                $this->db->from('order_booking_trans a');
                $this->db->join('consumer_master b', 'a.consumer_id=b.customer_no', 'inner');

                $res = $this->db->get();
                return $res->result_array();
                break;
            case 'GET_ALL_STATE':
                $state_res = $this->db->get('state_master');
                if ($state_res->num_rows() > 0) {
                    $state_data = $state_res->result_array();
                    foreach ($state_data as $key => $state):
                        $this->db->select('district_master.pk_district_code, district_master.district_name');
                        $this->db->where('district_master.state_code', $state['pk_state_code']);
                        $dist_res = $this->db->get('district_master');
                        if ($dist_res->num_rows() > 0) {
                            $dist_data = $dist_res->result_array();
                            $state_data[$key]['dist_data'] = $dist_data;
                        }
                    endforeach;
                }
                return $state_data;
                break;
            case 'GET_PAYMENT_TYPE':
                $this->db->select("gen_code,description");
                $this->db->from('gen_code_desc');
                $this->db->where('gen_code_group', 'PAYMENT_TYPE');
                $this->db->where('STATUS', 1);
                $this->db->order_by('sl_no');
                $res = $this->db->get();
                return $res->result_array();
                break;
            case 'GET_ALL_SCHEME_B2C':
                $this->db->select("CONCAT(scheme_id,'@',operation_type) AS scheme_id,scheme_name");
                $this->db->from('scheme_master');
                $this->db->where('scheme_type', 'B2C');
                $this->db->where('record_status', 1);
                $scheme_res = $this->db->get();
                if ($scheme_res->num_rows() > 0) {
                    $scheme_data = $scheme_res->result_array();
                    foreach ($scheme_data as $key => $scheme):
                        $exploded_scheme = explode("@", $scheme['scheme_id'])[0];
                        $this->db->select('b.product_id,b.product_name');
                        $this->db->from('scheme_product  a');
                        $this->db->join('product_master b', 'a.product_id=b.product_id', 'inner');
                        $this->db->where('a.scheme_id', $exploded_scheme);
                        $this->db->where('a.sl_no', 1);
                        $stove_res = $this->db->get();
                        if ($stove_res->num_rows() > 0) {
                            $stove_data = $stove_res->result_array();
                            $scheme_data[$key]['stove_data'] = $stove_data;
                        }
                    endforeach;
                }
                return $scheme_data;
                break;

            case 'GET_ALL_SCHEMEB2B':
                $this->db->select("CONCAT(scheme_id,'@',operation_type) AS scheme_id,scheme_name");
                $this->db->from('scheme_master');
                $this->db->where('scheme_type', 'B2B');
                $this->db->where('record_status', 1);
                $res = $this->db->get();
                return $res->result_array();
                break;
            //---------------------------------------------report B2b--------------------------//
            case 'GET_B2C_REPORT_LIST':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }                
                $sWhere = '';
                $search = $this->input->post('search');
                $header = array('memo_date','order_book_id','scheme_name','consumer_id','paymeny_type','total_amount','gst','gst_amt','cyl','reg','refill_amt','pmuy_loan');
                if ($search['value'] != '') {
                    $sWhere = " WHERE (";
                    for ($i = 0; $i < count($header); $i++) {
                        $sWhere .= "`" . $header[$i] . "`" . " LIKE '%" . $search['value'] . "%'" . " OR "; //mysql_real_escape_string( $_GET['sSearch'] )
                    }
                    $sWhere = substr_replace($sWhere, "", -3);
                    $sWhere .= ')';
                }
                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

               // $this->db->limit($iDisplayLength, $iDisplayStart);
                $b2c_qry = $this->db->query("SELECT memo_date,order_book_id,scheme_name,consumer_id,paymeny_type,total_amount,gst,
                    SUM(gst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM (
                    SELECT a.order_book_id,c.scheme_name,DATE_FORMAT(memo_date,'%d-%m-%Y') AS memo_date,consumer_id,
                    paymeny_type,total_amount,(cgst_rate+sgst_rate) AS gst,(cgst_amt+sgst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM 
                    order_booking_trans a INNER JOIN order_booking_details b ON a.order_book_id=b.order_book_id
                    INNER JOIN scheme_master c ON a.scheme_id=c.scheme_id WHERE c.scheme_type='B2C' )a $sWhere GROUP BY order_book_id limit $iDisplayLength offset $iDisplayStart");                               
               // $res = $b2c_qry->db->get();
                $query = $b2c_qry->result_array();
                $output = array("aaData" => array());

                

                $b2c_qry1 = $this->db->query("SELECT memo_date,order_book_id,scheme_name,consumer_id,paymeny_type,total_amount,gst,
                    SUM(gst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM (
                    SELECT a.order_book_id,c.scheme_name,DATE_FORMAT(memo_date,'%d-%m-%Y') AS memo_date,consumer_id,
                    paymeny_type,total_amount,(cgst_rate+sgst_rate) AS gst,(cgst_amt+sgst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM 
                    order_booking_trans a INNER JOIN order_booking_details b ON a.order_book_id=b.order_book_id
                    INNER JOIN scheme_master c ON a.scheme_id=c.scheme_id WHERE c.scheme_type='B2C' )a $sWhere GROUP BY order_book_id");                               
                $res1 = $b2c_qry1->result_array();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $b2c_qry1->num_rows();
                $output['iTotalDisplayRecords'] = $b2c_qry1->num_rows();
                //echo $output['iTotalDisplayRecords'].$output['iTotalRecords'];die();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {
                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }             
                return $output;
                break;
           case 'GET_B2B_REPORT_LIST':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $sWhere = '';
                $search = $this->input->post('search');
                $header = array('memo_date','order_book_id','scheme_name','consumer_name','paymeny_type','gst','cyl','reg','refill_amt','pmuy_loan');
                if ($search['value'] != '') {
                    $sWhere = " WHERE (";
                    for ($i = 0; $i < count($header); $i++) {
                        $sWhere .= "`" . $header[$i] . "`" . " LIKE '%" . $search['value'] . "%'" . " OR "; //mysql_real_escape_string( $_GET['sSearch'] )
                    }
                    $sWhere = substr_replace($sWhere, "", -3);
                    $sWhere .= ')';
                }
                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

               // $this->db->limit($iDisplayLength, $iDisplayStart);
                $b2b_qry = $this->db->query("SELECT memo_date,order_book_id,scheme_name,consumer_name,paymeny_type,SUM(quantity) AS total_item,total_amount,gst,SUM(gst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM (
                    SELECT a.order_book_id,c.scheme_name,consumer_name,quantity,DATE_FORMAT(memo_date,'%d-%m-%Y') AS memo_date,a.consumer_id,paymeny_type,total_amount,(cgst_rate+sgst_rate) AS gst,
                    (cgst_amt+sgst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM 
                    order_booking_trans a INNER JOIN order_booking_details b ON a.order_book_id=b.order_book_id
                    INNER JOIN scheme_master c ON a.scheme_id=c.scheme_id AND c.scheme_type='B2B' 
                    INNER JOIN consumer_master d ON a.consumer_id=d.consumer_id
                    WHERE c.scheme_type='B2B' )a $sWhere GROUP BY order_book_id limit $iDisplayLength offset $iDisplayStart");                               
               // $res = $b2c_qry->db->get();
                $query = $b2b_qry->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $b2b_qry1 = $this->db->query("SELECT memo_date,order_book_id,scheme_name,consumer_name,paymeny_type,SUM(quantity) AS total_item,total_amount,gst,SUM(gst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM (
                    SELECT a.order_book_id,c.scheme_name,consumer_name,quantity,DATE_FORMAT(memo_date,'%d-%m-%Y') AS memo_date,a.consumer_id,paymeny_type,total_amount,(cgst_rate+sgst_rate) AS gst,
                    (cgst_amt+sgst_amt) AS gst_amt,cyl,reg,refill_amt,pmuy_loan FROM 
                    order_booking_trans a INNER JOIN order_booking_details b ON a.order_book_id=b.order_book_id
                    INNER JOIN scheme_master c ON a.scheme_id=c.scheme_id AND c.scheme_type='B2B' 
                    INNER JOIN consumer_master d ON a.consumer_id=d.consumer_id
                    WHERE c.scheme_type='B2B' )a $sWhere GROUP BY order_book_id");                               
                $res1 = $b2b_qry1->result_array();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $b2b_qry1->num_rows();
                $output['iTotalDisplayRecords'] = $b2b_qry1->num_rows();
                //echo $output['iTotalDisplayRecords'].$output['iTotalRecords'];die();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {
                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }             
                return $output;               
                break;
          ///-------------------------------------Report View-------------------------------------//          
            case 'GET_ITEM_REPORT_LIST':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('item_id','item_name' ,'hsn_no','quantity','price','total');
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }


                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('order_booking_details');                
                $this->db->select("item_id,item_name ,hsn_no, SUM(quantity) AS quantity,price,SUM(total) AS total");                
                $this->db->where('record_status',1);
                $this->db->group_by('item_id');               
                $res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
                $this->db->from('order_booking_details');                
                $this->db->select("item_id,item_name ,hsn_no, SUM(quantity) AS quantity,price,SUM(total) AS total");                
                $this->db->where('record_status',1);
                $this->db->group_by('item_id');
                $res1 = $this->db->get();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;                
                break;


            case 'customer_details':
                $this->db->select("order_book_id,order_booking_trans.consumer_id,memo_no,date_format(memo_date,'%d-%m-%Y') as memo_date,paymeny_type,order_type,total_amount,consumer_name,consumer_address_line1,scheme_name,recover_from_customer,cyl,reg,refill_amt,tot_amt,pmuy_loan,rcv_frm_customer");
                $this->db->from('order_booking_trans');
                $this->db->join('scheme_master', 'scheme_master.scheme_id=order_booking_trans.scheme_id', 'inner');
                $this->db->join('consumer_master', 'order_booking_trans.consumer_id=consumer_master.customer_no', 'inner');
                $this->db->where('order_book_id', $data);
                $res = $this->db->get('');
                return $res->result_array();
                break;
            default:
                return array('status' => false, 'msg' => NO_OPERATION);
            case 'GET_CONSUMER_LIST':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('customer_no', 'consumer_name', 'consumer_address_line1', 'district_name', 'contact_no');
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }


                $iDisplayLength = $this->input->post('length');
                $iDisplayStart = $this->input->post('start');

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select("customer_no,consumer_name,consumer_address_line1,district_name,contact_no");
                $this->db->from('consumer_master');
                $this->db->join('district_master', 'district_master.pk_district_code=consumer_master.district_code', 'left');
                $this->db->where('record_status', 1);
                $res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());

                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
                $this->db->select("customer_no,consumer_name,consumer_address_line1,district_name,contact_no");
                $this->db->from('consumer_master');
                $this->db->join('district_master', 'district_master.pk_district_code=consumer_master.district_code', 'left');
                $this->db->where('record_status', 1);
                $res1 = $this->db->get();
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }

                    $output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;
                break;
        }
    }
}

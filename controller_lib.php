<?php

//require __DIR__ . '/db_connection.php';
include("../../config/con-class/Connection.php");
//ini_set('memory_limit', '-1');

class IVF
{

    protected $db;

    function __construct()
    {
        include("../../config/con-class/Connection.php");

        $this->db = $conn;
    }

//function to get the branch name
    public function branch($branch)
    {
       $query = $this->db->prepare("SELECT branchname FROM branch_tbl WHERE id = :branch ");
       $query->bindParam("branch", $branch, PDO::PARAM_STR);

       $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function ivf_waiting($pay_status,$bcode,$ccode)
    {
       $query = $this->db->prepare("SELECT daily_visit_tbl.id,daily_visit_tbl.vdate,daily_visit_tbl.vtime,daily_visit_tbl.prn,daily_visit_tbl.visitno,
       patient_records_tbl.fullname,patient_category_tbl.category,daily_visit_tbl.specialty,patient_records_tbl.phoneno,user_tbl.staffname,
       patient_records_tbl.gender,patient_records_tbl.marital_status,patient_records_tbl.dob,patient_records_tbl.age FROM daily_visit_tbl INNER JOIN 
       patient_records_tbl ON daily_visit_tbl.prn = patient_records_tbl.prn 
       INNER JOIN patient_category_tbl ON patient_records_tbl.category::integer = patient_category_tbl.id LEFT JOIN 
       user_tbl ON daily_visit_tbl.posted_by::integer = user_tbl.id WHERE 
       payment_status = :pay_status AND daily_visit_tbl.bcode = :bcode AND daily_visit_tbl.ccode = :ccode AND daily_visit_tbl.status IS NULL ");
       $query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);
       $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
       $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
       $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function get_patient_details($prn)
    {
       $query = $this->db->prepare("SELECT * FROM daily_visit_tbl INNER JOIN 
       patient_records_tbl ON daily_visit_tbl.prn = patient_records_tbl.prn INNER JOIN
       patient_category_tbl ON daily_visit_tbl.pat_category::integer = patient_category_tbl.id 
       WHERE daily_visit_tbl.prn = :prn ");
       $query->bindParam("prn", $prn, PDO::PARAM_STR);

       $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function get_donor_details($prn)
    {
       $query = $this->db->prepare("SELECT * FROM ivf_donor_tbl INNER JOIN 
       patient_records_tbl ON ivf_donor_tbl.prn = patient_records_tbl.prn INNER JOIN
       patient_category_tbl ON patient_records_tbl.category::integer = patient_category_tbl.id 
       WHERE ivf_donor_tbl.prn = :prn ");
       $query->bindParam("prn", $prn, PDO::PARAM_STR);

       $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function create_ivf_file($wife_name,$husband_name,$husband_age,$wife_age,$husband_occ,$wife_occ,$address,$husband_ph,
    $wife_ph,$ref_hosp,$marital_stat,$infertility_type,$med_his,$allergy,$surg_history,$per_his,$fam_his,
    $inv_done,$teh,$lap,$hyst,$pbi,$semen,$menstrual_con,$flow_nat,$dysm,$coital_bleeding,$lmp,$aware_fert,
    $dyspa,$height,$weight,$bmi,$thyroid,$breast_galact,$ovul_ind,$iui,$ivf,$summary,$usg_date,$uterus,$cavity,
    $lt_ovary,$rt_ovary,$afc_lt,$afc_rt,$findings,$counsel,$by,$note,$saved_by,$ivf_no,$prn,$date,$time,$bcode,$ccode,$status,$vsn,$donor)
    {
        $query = $this->db->prepare("INSERT INTO fert_pat(ivf_no,prn,wname,hname,w_age,h_age,w_occ,h_occ,add,
        w_phone,h_phone,ref_hosp,m_status,type_of_infer,med_his,surg_his,per_his,fam_his,inv_done,tubal_hsg,
        lap,hyst,prev_blood_inv,outside_semen,menstrual_condition,nature_of_flow,dysm,inter_mens,lmp,date,time,
        aware_of_fert,dyspareunia,height,weight,bmi,thyroid,breast_galact,ovul_induction,iui,ivf,summary,usg_date,
        uterus,cavity,lt_ovary,rt_ovary,afc_lt,afc_rt,abn_findings,counselling,done_by,note,saved_by,bcode,ccode,status,vsn,donor) 
        VALUES (:ivf_no,:prn,:wname,:hname,:w_age,:h_age,:w_occ,:h_occ,:add,:w_phone,:h_phone,:ref_hosp,:m_status,
        :type_of_infer,:med_his,:surg_his,:per_his,:fam_his,:inv_done,:tubal_hsg,:lap,:hyst,:prev_blood_inv,:outside_semen,
        :menstrual_condition,:nature_of_flow,:dysm,:inter_mens,:lmp,:date,:time,:aware_of_fert,:dyspareunia,:height,
        :weight,:bmi,:thyroid,:breast_galact,:ovul_ind,:iui,:ivf,:summary,:usg_date,:uterus,:cavity,:lt_ovary,:rt_ovary,
        :afc_lt,:afc_rt,:abn_findings,:counselling,:done_by,:note,:saved_by,:bcode,:ccode,:status,:vsn,:donor )");
        $query->bindParam("ivf_no", $ivf_no, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("wname", $wife_name, PDO::PARAM_STR);
        $query->bindParam("hname", $husband_name, PDO::PARAM_STR);
        $query->bindParam("w_age", $wife_age, PDO::PARAM_STR);
        $query->bindParam("h_age", $husband_age, PDO::PARAM_STR);
        $query->bindParam("w_occ", $wife_occ, PDO::PARAM_STR);
        $query->bindParam("h_occ", $husband_occ, PDO::PARAM_STR);
        $query->bindParam("add", $address, PDO::PARAM_STR);
        $query->bindParam("w_phone", $wife_ph, PDO::PARAM_STR);
        $query->bindParam("h_phone", $husband_ph, PDO::PARAM_STR);
        $query->bindParam("ref_hosp", $ref_hosp, PDO::PARAM_STR);
        $query->bindParam("m_status", $marital_stat, PDO::PARAM_STR);
        $query->bindParam("type_of_infer", $infertility_type, PDO::PARAM_STR);
        $query->bindParam("med_his", $med_his, PDO::PARAM_STR);
        $query->bindParam("surg_his", $surg_history, PDO::PARAM_STR);
        $query->bindParam("per_his", $per_his, PDO::PARAM_STR);
        $query->bindParam("fam_his", $fam_his, PDO::PARAM_STR);
        $query->bindParam("inv_done", $inv_done, PDO::PARAM_STR);
        $query->bindParam("tubal_hsg", $teh, PDO::PARAM_STR);
        $query->bindParam("lap", $lap, PDO::PARAM_STR);
        $query->bindParam("hyst", $hyst, PDO::PARAM_STR);
        $query->bindParam("prev_blood_inv", $pbi, PDO::PARAM_STR);
        $query->bindParam("outside_semen", $semen, PDO::PARAM_STR);
        $query->bindParam("menstrual_condition", $menstrual_con, PDO::PARAM_STR);
        $query->bindParam("nature_of_flow", $flow_nat, PDO::PARAM_STR);
        $query->bindParam("dysm", $dysm, PDO::PARAM_STR);
        $query->bindParam("inter_mens", $coital_bleeding, PDO::PARAM_STR);
        $query->bindParam("lmp", $lmp, PDO::PARAM_STR);
        $query->bindParam("date", $date, PDO::PARAM_STR);
        $query->bindParam("time", $time, PDO::PARAM_STR);
        $query->bindParam("aware_of_fert", $aware_fert, PDO::PARAM_STR);
        $query->bindParam("dyspareunia", $dyspa, PDO::PARAM_STR);
        $query->bindParam("height", $height, PDO::PARAM_STR);
        $query->bindParam("weight", $weight, PDO::PARAM_STR);
        $query->bindParam("bmi", $bmi, PDO::PARAM_STR);
        $query->bindParam("thyroid", $thyroid, PDO::PARAM_STR);
        $query->bindParam("breast_galact", $breast_galact, PDO::PARAM_STR);
        $query->bindParam("ovul_ind", $ovul_ind, PDO::PARAM_STR);
        $query->bindParam("ivf", $ivf, PDO::PARAM_STR);
        $query->bindParam("iui", $iui, PDO::PARAM_STR);
        $query->bindParam("summary", $summary, PDO::PARAM_STR);
        $query->bindParam("usg_date", $usg_date, PDO::PARAM_STR);
        $query->bindParam("uterus", $uterus, PDO::PARAM_STR);
        $query->bindParam("cavity", $cavity, PDO::PARAM_STR);
        $query->bindParam("lt_ovary", $lt_ovary, PDO::PARAM_STR);
        $query->bindParam("rt_ovary", $rt_ovary, PDO::PARAM_STR);
        $query->bindParam("afc_lt", $afc_lt, PDO::PARAM_STR);
        $query->bindParam("afc_rt", $afc_rt, PDO::PARAM_STR);
        $query->bindParam("abn_findings", $findings, PDO::PARAM_STR);
        $query->bindParam("counselling", $counsel, PDO::PARAM_STR);
        $query->bindParam("done_by", $by, PDO::PARAM_STR);
        $query->bindParam("note", $note, PDO::PARAM_STR);
        $query->bindParam("saved_by", $saved_by, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("donor", $donor, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function get_ivf_file($prn)
    {
        $query = $this->db->prepare("SELECT patient_records_tbl.prn,patient_records_tbl.fullname,patient_records_tbl.category AS cat,  
        patient_records_tbl.phoneno,patient_records_tbl.nok_phone,gender,patient_records_tbl.marital_status,patient_records_tbl.dob,
        patient_records_tbl.age,patient_category_tbl.category,patient_records_tbl.sponsor,patient_records_tbl.plan_type,fert_pat.ivf_no,
        fert_pat.vsn,corporate_client_tbl.corporate_name,patient_records_tbl.pass_path,fert_pat.donor 
        FROM fert_pat INNER JOIN patient_records_tbl
        ON fert_pat.prn = patient_records_tbl.prn INNER JOIN patient_category_tbl ON 
        patient_records_tbl.category::integer = patient_category_tbl.id LEFT JOIN
        corporate_client_tbl ON patient_records_tbl.sponsor::integer = corporate_client_tbl.id
        WHERE fert_pat.prn = :prn AND fert_pat.status = 'OPEN' ");
        
        //$query->bindParam("date", $date, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
       // $query->bindParam("saved_by", $saved_by, PDO::PARAM_STR);
       $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function existing_ivf_pat()
    {
       $query = $this->db->prepare("SELECT * FROM fert_pat LEFT JOIN 
       patient_records_tbl ON fert_pat.prn = patient_records_tbl.prn LEFT JOIN
       user_tbl ON fert_pat.saved_by::integer = user_tbl.id::integer LEFT JOIN
       patient_category_tbl ON patient_records_tbl.category::integer = patient_category_tbl.id     
       WHERE fert_pat.status = 'OPEN' ORDER BY fert_pat.id ASC");
       //$query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);

       $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function ivf_donor_list()
    {
       $query = $this->db->prepare("SELECT ivf_donor_tbl.date,ivf_donor_tbl.time,ivf_donor_tbl.id,ivf_donor_tbl.prn,
       patient_records_tbl.fullname,patient_category_tbl.category,patient_records_tbl.gender,patient_records_tbl.marital_status,
       patient_records_tbl.dob,patient_records_tbl.age,patient_records_tbl.phoneno,user_tbl.staffname FROM ivf_donor_tbl INNER JOIN 
       patient_records_tbl ON ivf_donor_tbl.prn = patient_records_tbl.prn INNER JOIN
       user_tbl ON ivf_donor_tbl.by::integer = user_tbl.id::integer INNER JOIN
       patient_category_tbl ON patient_records_tbl.category::integer = patient_category_tbl.id  
       WHERE ivf_donor_tbl.status = 'OPEN' ORDER BY ivf_donor_tbl.id DESC ");
       //$query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);

       $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function ivf_counselling_list()
    {
       $query = $this->db->prepare("SELECT * FROM ivf_counselling WHERE status IS NULL ORDER BY id DESC ");
       //$query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);

       $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function Create_tab1($tab1, $dosage1, $freq1, $dur1, $qty1,$physio_instruct1,$prn_drug,$pt_time,
    $pt_date,$route1,$drug_group_id,$drug_id,$cost,$sales,$totamt1,$d_sg_id,$staffname,$ivfno,$status,$payment_status,$sponsorid,$bcode,$ccode,$qty_dispensed,$pres_bal1,$qty_ind1,$ind_bal1,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn)
    {
        if(!empty($tab1) || !empty($dosage1) || !empty($freq1) || !empty($qty1) || !empty($physio_instruct1) ){

        $query = $this->db->prepare("INSERT INTO prescription_tbl(doctor_instruction,prn,pdate,ptime,drug_group_id,
        drug_id,dosage,duration,totqty,unitcost,unitsales,frequency,totamt,route,drug_subgroup_id,prescribeby_id,visit_number,status,payment_status,sponsorid,bcode,ccode,pres_bal,qty_ind,qty_dis,indent_bal,age,patient_category,patient_type,ipno,post_status,ivf_no) 
        VALUES (:physio_instruct1,:prn_drug,:pt_date,:pt_time,:d_g_id,:drug_id,:dosage1,:dur1,:qty1,:unitcost,
        :unitsales,:freq1,:totamt1,:route1,:d_sg_id,:prescribed_by,:vsn,:status::varchar,:payment_status,:sponsorid,:bcode,:ccode,:pres_bal1,:qty_ind1,:qty_dispensed,:ind_bal1,:age,:pat_cat,:pat_type,:ipno,:post_status,:ivfno)");
        $query->bindParam("physio_instruct1", $physio_instruct1, PDO::PARAM_STR);
        $query->bindParam("prn_drug", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("pt_date", $pt_date, PDO::PARAM_STR);
        $query->bindParam("pt_time", $pt_time, PDO::PARAM_STR);
        $query->bindParam("d_g_id", $drug_group_id, PDO::PARAM_STR);
        $query->bindParam("dosage1", $dosage1, PDO::PARAM_STR);
        $query->bindParam("drug_id", $drug_id, PDO::PARAM_STR);
        $query->bindParam("dur1", $dur1, PDO::PARAM_STR);
        $query->bindParam("qty1", $qty1, PDO::PARAM_STR);
        $query->bindParam("unitcost", $cost, PDO::PARAM_STR);
        $query->bindParam("unitsales", $sales, PDO::PARAM_STR);
        $query->bindParam("freq1", $freq1, PDO::PARAM_STR);
        $query->bindParam("totamt1", $totamt1, PDO::PARAM_STR);
        $query->bindParam("route1", $route1, PDO::PARAM_STR);
        $query->bindParam("d_sg_id", $d_sg_id, PDO::PARAM_STR);
        $query->bindParam("prescribed_by", $staffname, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("sponsorid", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("qty_dispensed", $qty_dispensed, PDO::PARAM_STR);
        $query->bindParam("pres_bal1", $pres_bal1, PDO::PARAM_STR);
        $query->bindParam("qty_ind1", $qty_ind1, PDO::PARAM_STR);
        $query->bindParam("ind_bal1", $ind_bal1, PDO::PARAM_STR);
        $query->bindParam("age", $age, PDO::PARAM_STR);
        $query->bindParam("pat_cat", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
        $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();
    }
}

    public function Create_tab2($tab2, $dosage2, $freq2, $dur2, $qty2,$physio_instruct2, $prn_drug,$pt_time,
    $pt_date,$route2,$drug_group_id2,$drug_id2,$cost2,$sales2,$totamt2,$d_sg_id2,$staffname,$ivfno,$status,$payment_status,$sponsorid,$bcode,$ccode,$qty_dispensed,$pres_bal2,$qty_ind2,$ind_bal2,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn)
    {
        if(!empty($tab2) || !empty($dosage2) || !empty($freq2) || !empty($qty2) || !empty($physio_instruct2) ){           
        
            $query = $this->db->prepare("INSERT INTO prescription_tbl(doctor_instruction,prn,pdate,ptime,drug_group_id,
        drug_id,dosage,duration,totqty,unitcost,unitsales,frequency,totamt,route,drug_subgroup_id,prescribeby_id,visit_number,status,payment_status,sponsorid,bcode,ccode,pres_bal,qty_ind,qty_dis,indent_bal,age,patient_category,patient_type,ipno,post_status,ivf_no) 
        VALUES (:physio_instruct2,:prn_drug,:pt_date,:pt_time,:d_g_id,:drug_id,:dosage2,:dur2,:qty2,:unitcost,
        :unitsales,:freq2,:totamt2,:route2,:d_sg_id,:prescribed_by,:vsn,:status::varchar,:payment_status,:sponsorid,:bcode,:ccode,:pres_bal2,:qty_ind2,:qty_dispensed,:ind_bal2,:age,:pat_cat,:pat_type,:ipno,:post_status,:ivfno)");
        $query->bindParam("physio_instruct2", $physio_instruct2, PDO::PARAM_STR);
        $query->bindParam("prn_drug", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("pt_date", $pt_date, PDO::PARAM_STR);
        $query->bindParam("pt_time", $pt_time, PDO::PARAM_STR);
        $query->bindParam("d_g_id", $drug_group_id2, PDO::PARAM_STR);
        $query->bindParam("dosage2", $dosage2, PDO::PARAM_STR);
        $query->bindParam("drug_id", $drug_id2, PDO::PARAM_STR);
        $query->bindParam("dur2", $dur2, PDO::PARAM_STR);
        $query->bindParam("qty2", $qty2, PDO::PARAM_STR);
        $query->bindParam("unitcost", $cost2, PDO::PARAM_STR);
        $query->bindParam("unitsales", $sales2, PDO::PARAM_STR);
        $query->bindParam("freq2", $freq2, PDO::PARAM_STR);
        $query->bindParam("totamt2", $totamt2, PDO::PARAM_STR);
        $query->bindParam("route2", $route2, PDO::PARAM_STR);
        $query->bindParam("d_sg_id", $d_sg_id2, PDO::PARAM_STR);
        $query->bindParam("prescribed_by", $staffname, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("sponsorid", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("qty_dispensed", $qty_dispensed, PDO::PARAM_STR);
        $query->bindParam("pres_bal2", $pres_bal2, PDO::PARAM_STR);
        $query->bindParam("qty_ind2", $qty_ind2, PDO::PARAM_STR);
        $query->bindParam("ind_bal2", $ind_bal2, PDO::PARAM_STR);
        $query->bindParam("age", $age, PDO::PARAM_STR);
        $query->bindParam("pat_cat", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
        $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();
        }
    }

    public function Create_liq1($liq1,$drug_group_id,$d_sg_id,$drug_id,$cost,$sales,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty1,$route1,$physio_instruct_liq1,$payment_status,$sponsorid,$bcode,$ccode,$totamt1,$pres_bal1,$qty_ind1,$ind_bal1,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn)
    {
                 
        if(!empty($liq1) || !empty($qty1) || !empty($route1) || !empty($physio_instruct_liq1) ){

            $query = $this->db->prepare("INSERT INTO prescription_tbl(doctor_instruction,prn,pdate,ptime,drug_group_id,drug_id,totqty,unitcost,unitsales,totamt,
            route,drug_subgroup_id,prescribeby_id,visit_number,status,sponsorid,bcode,ccode,age,qty_dis,pres_bal,indent_bal,qty_ind,patient_category,patient_type,ipno,payment_status,post_status,ivf_no) 
            VALUES (:physio_instruct_liq1,:prn_drug,:pt_date,:pt_time,:d_g_id,:drug_id,:qty1,:unitcost,
            :unitsales,:totamt1,:route1,:d_sg_id,:prescribed_by,:vsn,:status::varchar,:sponsorid,:bcode,:ccode,:age,:qty_dis,:pres_bal1,:ind_bal1,:qty_ind1,:pat_cat,:pat_type,:ipno,:pay_status,:post_status,:ivfno)");
            $query->bindParam("physio_instruct_liq1", $physio_instruct_liq1, PDO::PARAM_STR);
            $query->bindParam("prn_drug", $prn_drug, PDO::PARAM_STR);
            $query->bindParam("pt_date", $pt_date, PDO::PARAM_STR);
            $query->bindParam("pt_time", $pt_time, PDO::PARAM_STR);
            $query->bindParam("d_g_id", $drug_group_id, PDO::PARAM_STR);
            $query->bindParam("drug_id", $drug_id, PDO::PARAM_STR);
        //$query->bindParam("dur2", $dur2, PDO::PARAM_STR);
            $query->bindParam("qty1", $qty1, PDO::PARAM_STR);
            $query->bindParam("unitcost", $cost, PDO::PARAM_STR);
            $query->bindParam("unitsales", $sales, PDO::PARAM_STR);
        //$query->bindParam("freq2", $freq2, PDO::PARAM_STR);
            $query->bindParam("totamt1", $totamt1, PDO::PARAM_STR);
            $query->bindParam("route1", $route1, PDO::PARAM_STR);
            $query->bindParam("d_sg_id", $d_sg_id, PDO::PARAM_STR);
            $query->bindParam("prescribed_by", $staffname, PDO::PARAM_STR);
            $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
            $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
            $query->bindParam("status", $status, PDO::PARAM_STR);
            $query->bindParam("sponsorid", $sponsorid, PDO::PARAM_STR);
            $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
            $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
            $query->bindParam("qty_dis", $qty_dis, PDO::PARAM_STR);
            $query->bindParam("age", $age, PDO::PARAM_STR);
            $query->bindParam("qty_ind1", $qty_ind1, PDO::PARAM_STR);
            $query->bindParam("pres_bal1", $pres_bal1, PDO::PARAM_STR);
            $query->bindParam("ind_bal1", $ind_bal1, PDO::PARAM_STR);
            $query->bindParam("pat_cat", $pat_cat, PDO::PARAM_STR);
            $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
            $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
            $query->bindParam("pay_status", $payment_status, PDO::PARAM_STR);
            $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
            $query->execute();
            return $this->db->lastInsertId();
        }
    }

    public function Create_liq2($liq2,$drug_group_id2,$d_sg_id2,$drug_id2,$cost2,$sales2,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty2,$route2,$physio_instruct_liq2,$payment_status,$sponsorid,$bcode,$ccode,$totamt2,$pres_bal2,$qty_ind2,$ind_bal2,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn)
    {
        if(!empty($liq2) || !empty($qty2) || !empty($route2) || !empty($physio_instruct_liq2) ){ 
        
            $query = $this->db->prepare("INSERT INTO prescription_tbl(doctor_instruction,prn,pdate,ptime,drug_group_id,drug_id,totqty,unitcost,unitsales,totamt,
            route,drug_subgroup_id,prescribeby_id,visit_number,status,sponsorid,bcode,ccode,age,qty_dis,pres_bal,indent_bal,qty_ind,patient_category,patient_type,ipno,payment_status,post_status,ivf_no) 
            VALUES (:physio_instruct_liq2,:prn_drug,:pt_date,:pt_time,:d_g_id,:drug_id,:qty2,:unitcost,
            :unitsales,:totamt2,:route2,:d_sg_id,:prescribed_by,:vsn,:status::varchar,:sponsorid,:bcode,:ccode,:age,:qty_dis,:pres_bal2,:ind_bal2,:qty_ind2,:pat_cat,:pat_type,:ipno,:pay_status,:post_status,ivfno)");
            $query->bindParam("physio_instruct_liq2", $physio_instruct_liq2, PDO::PARAM_STR);
            $query->bindParam("prn_drug", $prn_drug, PDO::PARAM_STR);
            $query->bindParam("pt_date", $pt_date, PDO::PARAM_STR);
            $query->bindParam("pt_time", $pt_time, PDO::PARAM_STR);
            $query->bindParam("d_g_id", $drug_group_id2, PDO::PARAM_STR);
            $query->bindParam("drug_id", $drug_id2, PDO::PARAM_STR);
        //$query->bindParam("dur2", $dur2, PDO::PARAM_STR);
            $query->bindParam("qty2", $qty2, PDO::PARAM_STR);
            $query->bindParam("unitcost", $cost2, PDO::PARAM_STR);
            $query->bindParam("unitsales", $sales2, PDO::PARAM_STR);
        //$query->bindParam("freq2", $freq2, PDO::PARAM_STR);
            $query->bindParam("totamt2", $totamt2, PDO::PARAM_STR);
            $query->bindParam("route2", $route2, PDO::PARAM_STR);
            $query->bindParam("d_sg_id", $d_sg_id2, PDO::PARAM_STR);
            $query->bindParam("prescribed_by", $staffname, PDO::PARAM_STR);
            $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
            $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
            $query->bindParam("status", $status, PDO::PARAM_STR);
            $query->bindParam("sponsorid", $sponsorid, PDO::PARAM_STR);
            $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
            $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
            $query->bindParam("qty_dis", $qty_dis, PDO::PARAM_STR);
            $query->bindParam("age", $age, PDO::PARAM_STR);
            $query->bindParam("qty_ind2", $qty_ind2, PDO::PARAM_STR);
            $query->bindParam("pres_bal2", $pres_bal2, PDO::PARAM_STR);
            $query->bindParam("ind_bal2", $ind_bal2, PDO::PARAM_STR);
            $query->bindParam("pat_cat", $pat_cat, PDO::PARAM_STR);
            $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
            $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
            $query->bindParam("pay_status", $payment_status, PDO::PARAM_STR);
            $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
            $query->execute();
        return $this->db->lastInsertId();
        }
        
    }

    public function Create_con1($con1,$drug_group_id,$d_sg_id,$drug_id,$cost,$sales,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty,$physio_instruct_con1,$payment_status,$sponsorid,$bcode,$ccode,$totamt1,$pres_bal1,$qty_ind1,$ind_bal1,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn)
    {
        if(!empty($con1) || !empty($qty1) || !empty($physio_instruct_con1) ){    
        
            $query = $this->db->prepare("INSERT INTO prescription_tbl(doctor_instruction,prn,pdate,ptime,drug_group_id,
            drug_id,totqty,drug_subgroup_id,prescribeby_id,visit_number,status,payment_status,sponsorid,bcode,ccode,age,qty_dis,pres_bal,indent_bal,qty_ind,patient_category,totamt,unitcost,unitsales,patient_type,ipno,post_status,ivf_no) 
            VALUES (:physio_instruct_con1,:prn_drug,:pt_date,:pt_time,:d_g_id,:drug_id,:qty,:d_sg_id,:prescribed_by,:vsn,:status::varchar,:payment_status,:sponsorid,:bcode,:ccode,:age,:qty_dis,:pres_bal1,:ind_bal1,:qty_ind1,:pat_cat,:totamt1::money,:unitcost::money,:unitsales::money,:pat_type,:ipno,:post_status,:ivfno)");        
        $query->bindParam("physio_instruct_con1", $physio_instruct_con1, PDO::PARAM_STR);
        $query->bindParam("prn_drug", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("pt_date", $pt_date, PDO::PARAM_STR);
        $query->bindParam("pt_time", $pt_time, PDO::PARAM_STR);
        $query->bindParam("d_g_id", $drug_group_id, PDO::PARAM_STR);
        //$query->bindParam("dosage2", $dosage2, PDO::PARAM_STR);
        $query->bindParam("drug_id", $drug_id, PDO::PARAM_STR);
        //$query->bindParam("dur2", $dur2, PDO::PARAM_STR);
        $query->bindParam("qty", $qty, PDO::PARAM_STR);
        $query->bindParam("unitcost", $cost, PDO::PARAM_STR);
        $query->bindParam("unitsales", $sales, PDO::PARAM_STR);
        //$query->bindParam("freq2", $freq2, PDO::PARAM_STR);
        $query->bindParam("totamt1", $totamt1, PDO::PARAM_STR);
        //$query->bindParam("route2", $route2, PDO::PARAM_STR);
        $query->bindParam("d_sg_id", $d_sg_id, PDO::PARAM_STR);
        $query->bindParam("prescribed_by", $staffname, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("sponsorid", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("qty_dis", $qty_dis, PDO::PARAM_STR);
        $query->bindParam("qty_ind1", $qty_ind1, PDO::PARAM_STR);
        $query->bindParam("pres_bal1", $pres_bal1, PDO::PARAM_STR);
        $query->bindParam("ind_bal1", $ind_bal1, PDO::PARAM_STR);
        $query->bindParam("age", $age, PDO::PARAM_STR);
        $query->bindParam("pat_cat", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
        $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
      //  $query->bindParam("med_history", $med_history, PDO::PARAM_STR);
      //  $query->bindParam("drug_history", $drug_history, PDO::PARAM_STR);
       // $query->bindParam("fam_history", $fam_history, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
        }
        
    }

    public function Create_con2($liq2,$drug_group_id2,$d_sg_id2,$drug_id2,$cost2,$sales2,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty2,$physio_instruct_con2,$payment_status,$sponsorid,$bcode,$ccode,$totamt2,$pres_bal2,$qty_ind2,$ind_bal2,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn)
    {
                 
        if(!empty($con2) || !empty($qty2) || !empty($physio_instruct_con2) ){  

            $query = $this->db->prepare("INSERT INTO prescription_tbl(doctor_instruction,prn,pdate,ptime,drug_group_id,
            drug_id,totqty,drug_subgroup_id,prescribeby_id,visit_number,status,payment_status,sponsorid,bcode,ccode,age,qty_dis,pres_bal,indent_bal,qty_ind,patient_category,totamt,unitcost,unitsales,patient_type,ipno,post_status,ivf_no) 
            VALUES (:physio_instruct_con1,:prn_drug,:pt_date,:pt_time,:d_g_id,:drug_id,:qty,:d_sg_id,:prescribed_by,:vsn,:status::varchar,:payment_status,:sponsorid,:bcode,:ccode,:age,:qty_dis,:pres_bal1,:ind_bal1,:qty_ind1,:pat_cat,:totamt1::money,:unitcost::money,:unitsales::money,:pat_type,:ipno,:post_status,:ivfno)");        
        $query->bindParam("physio_instruct_con1", $physio_instruct_con2, PDO::PARAM_STR);
        $query->bindParam("prn_drug", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("pt_date", $pt_date, PDO::PARAM_STR);
        $query->bindParam("pt_time", $pt_time, PDO::PARAM_STR);
        $query->bindParam("d_g_id", $drug_group_id2, PDO::PARAM_STR);
        //$query->bindParam("dosage2", $dosage2, PDO::PARAM_STR);
        $query->bindParam("drug_id", $drug_id2, PDO::PARAM_STR);
        //$query->bindParam("dur2", $dur2, PDO::PARAM_STR);
        $query->bindParam("qty", $qty2, PDO::PARAM_STR);
        $query->bindParam("unitcost", $cost2, PDO::PARAM_STR);
        $query->bindParam("unitsales", $sales2, PDO::PARAM_STR);
        //$query->bindParam("freq2", $freq2, PDO::PARAM_STR);
        $query->bindParam("totamt1", $totamt2, PDO::PARAM_STR);
        //$query->bindParam("route2", $route2, PDO::PARAM_STR);
        $query->bindParam("d_sg_id", $d_sg_id2, PDO::PARAM_STR);
        $query->bindParam("prescribed_by", $staffname, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("sponsorid", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("qty_dis", $qty_dis, PDO::PARAM_STR);
        $query->bindParam("qty_ind1", $qty_ind2, PDO::PARAM_STR);
        $query->bindParam("pres_bal1", $pres_bal2, PDO::PARAM_STR);
        $query->bindParam("ind_bal1", $ind_bal2, PDO::PARAM_STR);
        $query->bindParam("age", $age, PDO::PARAM_STR);
        $query->bindParam("pat_cat", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
        $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
      //  $query->bindParam("med_history", $med_history, PDO::PARAM_STR);
      //  $query->bindParam("drug_history", $drug_history, PDO::PARAM_STR);
       // $query->bindParam("fam_history", $fam_history, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
        }
        
    }

    public function get_user_dept($dept,$bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT dept.id FROM dept WHERE unitname = :dept AND bcode = :bcode AND ccode = :ccode");
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function pharmacy_items_for_ivf($bcode,$ccode,$fer)
    {
        
        $query = $this->db->prepare("SELECT visit_number,patient_records_tbl.prn,pdate,prescription_tbl.wtrack,patient_records_tbl.fullname,patient_records_tbl.category,corporate_client_tbl.corporate_name,
        prescription_tbl.sponsorid,user_tbl.staffname
        FROM prescription_tbl INNER JOIN 
        patient_records_tbl ON prescription_tbl.prn = patient_records_tbl.prn INNER JOIN
        user_tbl ON prescription_tbl.prescribeby_id::integer = user_tbl.id LEFT JOIN
        corporate_client_tbl ON prescription_tbl.sponsorid::integer = corporate_client_tbl.id
        where prescription_tbl.bcode = :bcode AND prescription_tbl.ccode = :ccode AND prescription_tbl.patient_type::integer = :fer AND prescription_tbl.status = 'NOT DISPENSED'
        GROUP BY visit_number,patient_records_tbl.prn,pdate,prescription_tbl.wtrack,patient_records_tbl.fullname,patient_records_tbl.category,corporate_client_tbl.corporate_name,prescription_tbl.sponsorid,user_tbl.staffname ORDER BY visit_number  ");
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("fer", $fer, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function load_drugs($ivfno)
    {
        
        $query = $this->db->prepare("SELECT prescription_tbl.id,prescription_tbl.pdate,prescription_tbl.ptime,prescription_tbl.status,prescription_tbl.duration,
        item__tbl.itemname,prescription_tbl.dosage,prescription_tbl.frequency,prescription_tbl.totqty,prescription_tbl.totamt,user_tbl.staffname 
        FROM prescription_tbl LEFT JOIN user_tbl ON prescribeby_id = user_tbl.id INNER JOIN item__tbl ON prescription_tbl.drug_id::integer = item__tbl.id 
         WHERE ivf_no = :ivfno::varchar ORDER BY prescription_tbl.id ");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    public function get_private_tariff($a,$bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT * FROM private_tariff WHERE serviceid = :a AND bcode = :bcode AND ccode = :ccode 
        ORDER BY serviceid DESC LIMIT 1");
        $query->bindParam("a", $a, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_insurance_tariff($a,$sponsor)
    {
        $query = $this->db->prepare("SELECT * FROM insurance_tariff WHERE serviceid = :a AND sponsorid = :sponsor ORDER BY serviceid DESC LIMIT 1");
        $query->bindParam("a", $a, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_corporate_tariff($a,$sponsor)
    {
        $query = $this->db->prepare("SELECT * FROM corporate_tariff WHERE serviceid = :a AND sponsorid = :sponsor ORDER BY serviceid DESC LIMIT 1");
        $query->bindParam("a", $a, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_service($a)
    {
        $query = $this->db->prepare("SELECT * FROM all__services_tbl WHERE id = :a");
        $query->bindParam("a", $a, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function add_service($service,$orderdate,$ordertime,$prn,$unit,$testname,$dept,$age,$category,$sponsor,$plan_type,
    $service_amt,$pacode,$doctorname,$status,$vsn,$hospital_amt,$agreed_amt,$service_cat_id,$pat_type,$pay_status,$ipno,$bcode,$ccode)
    {
        $query = $this->db->prepare("INSERT INTO ip_daily_order(orderdate,ordertime,prn,unit,testname,dept,age,category,sponsor,plan_type,pacode,service_amt,doctorname,status,visit_number,hospital_amt,agreed_amt,service_category_id,patient_type,payment_status,ipno,bcode,ccode) 
        VALUES (:orderdate,:ordertime,:prn,:unit,:testname,:dept,:age,:category,:sponsor,:plan_type,:pacode,:service_amt::money,:doctorname,:status,:vsn,:hospital_amt::money,:agreed_amt::money,:service_cat_id,:pat_type,:pay_status,:ipno,:bcode,:ccode)");
        $query->bindParam("orderdate", $orderdate, PDO::PARAM_STR);
        $query->bindParam("ordertime", $ordertime, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("unit", $unit, PDO::PARAM_STR);
        $query->bindParam("testname", $testname, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("age", $age, PDO::PARAM_STR);
        $query->bindParam("category", $category, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->bindParam("plan_type", $plan_type, PDO::PARAM_STR);        
        $query->bindParam("pacode", $pacode, PDO::PARAM_STR);
        $query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $doctorname, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $hospital_amt, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $agreed_amt, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_cat_id, PDO::PARAM_STR);
        $query->bindParam("pat_type", $pat_type, PDO::PARAM_STR);
        $query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);
        $query->bindParam("ipno", $ipno, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function family_transaction($orderdate,$ordertime,$prn,$category,$testname,$hospital_amt,$agreed_amt,$payment_status,
    $trans_status,$doctorname,$bcode,$ccode,$service_cat_id,$unit,$timestamp,$specialty_id,$vsn,$post_status,$total,$sponsor,$qty,$dept,$service_amt,$source){

        $query = $this->db->prepare("INSERT INTO family_transactions(visitdate,ordertime,prn,patient_type,items,cost,agreed_amt,qty,dept,payment_status,trans_status,postedby,bcode,ccode,service_category_id,subunit_id,tstamp,specialty_id,visit_number,post_status,total,family_sponsor_id,source_tbl_id) 
        VALUES (:orderdate,:ordertime,:prn,:category,:testname,:hospital_amt::money,:agreed_amt::money,:qty,:dept,:payment_status,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:unit,:timestamp,:specialty_id,:vsn,:post_status,:total,:sponsor,:source)");
        $query->bindParam("orderdate", $orderdate, PDO::PARAM_STR);
        $query->bindParam("ordertime", $ordertime, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("unit", $unit, PDO::PARAM_STR);
        $query->bindParam("testname", $testname, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("qty", $qty, PDO::PARAM_STR);
        $query->bindParam("category", $category, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);        
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $doctorname, PDO::PARAM_STR);
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $agreed_amt, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_cat_id, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        $query->bindParam("total", $total, PDO::PARAM_STR);
        $query->bindParam("source", $source, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();

    }

    public function private_transaction($orderdate,$ordertime,$prn,$category,$testname,$hospital_amt,$agreed_amt,$payment_status,
    $trans_status,$doctorname,$bcode,$ccode,$service_cat_id,$unit,$timestamp,$specialty_id,$vsn,$post_status,$total,$sponsor,$qty,$dept,$service_amt,$source){

        $query = $this->db->prepare("INSERT INTO pay_now_transactions(visitdate,ordertime,prn,patient_type,items,cost,agreed_amt,qty,dept,payment_status,trans_status,postedby,bcode,ccode,service_category_id,subunit_id,tstamp,specialty_id,visit_number,post_status,total,source_tbl_id) 
        VALUES (:orderdate,:ordertime,:prn,:category,:testname,:hospital_amt::money,:agreed_amt::money,:qty,:dept,:payment_status,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:unit,:timestamp,:specialty_id,:vsn,:post_status,:total,:source)");
        $query->bindParam("orderdate", $orderdate, PDO::PARAM_STR);
        $query->bindParam("ordertime", $ordertime, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("unit", $unit, PDO::PARAM_STR);
        $query->bindParam("testname", $testname, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("qty", $qty, PDO::PARAM_STR);
        $query->bindParam("category", $category, PDO::PARAM_STR);
        //$query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);        
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $doctorname, PDO::PARAM_STR);
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $agreed_amt, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_cat_id, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        $query->bindParam("total", $total, PDO::PARAM_STR);
        $query->bindParam("source", $source, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();

    }

    public function pay_later($orderdate,$ordertime,$prn,$category,$testname,$hospital_amt,$agreed_amt,$cost,$qty,$dept,$trans_status,$doctorname,$bcode,$ccode,
    $service_cat_id,$sponsor,$specialty_id,$vsn,$total,$pl_status,$cap_status,$pacode,$unit,$payment_status,$timestamp,$service_amt,$source){

        $query = $this->db->prepare("INSERT INTO pay_later_transaction_tbl(visitdate,ordertime,prn,items,cost,private_amt,agreed_amt,qty,dept,trans_status,postedby,bcode,ccode,service_category_id,pat_category,sponsorid,specialty_id,visit_number,tot_amt,status,payment_status,sub_unit_id,tstamp,source_tbl_id,cap_status,pacode) 
        VALUES (:orderdate,:ordertime,:prn,:testname,:cost, :hospital_amt, :agreed_amt,:qty,:dept,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:category,:sponsor,:specialty_id,:vsn,:total,:status,:payment_status,:unit,:timestamp,:source,:cap_status,:pacode)");
        $query->bindParam("orderdate", $orderdate, PDO::PARAM_STR);
        $query->bindParam("ordertime", $ordertime, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("unit", $unit, PDO::PARAM_STR);
        $query->bindParam("testname", $testname, PDO::PARAM_STR);
        $query->bindParam("cost", $cost, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $agreed_amt, PDO::PARAM_STR);
        $query->bindParam("qty", $qty, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        $query->bindParam("doctorname", $doctorname, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_cat_id, PDO::PARAM_STR);      
        $query->bindParam("category", $category, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("total", $total, PDO::PARAM_STR);
        $query->bindParam("status", $pl_status, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("cap_status", $cap_status, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("source", $source, PDO::PARAM_STR);
        $query->bindParam("pacode", $pacode, PDO::PARAM_STR);        
        
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();

    }

    public function get_cat($category)
    {
       
       $query = $this->db->prepare("SELECT category FROM patient_category_tbl WHERE id = :category");
      
       $query->bindParam("category", $category, PDO::PARAM_STR);
       $query->execute();        
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function set_ivf_no($prn)
    {
       
       $query = $this->db->prepare("SELECT id FROM patient_visit_tbl WHERE prn = :prn ORDER BY id DESC LIMIT 1");
      
       $query->bindParam("prn", $prn, PDO::PARAM_STR);
       $query->execute();        
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function get_branch_prefix($bcode)
    {
       
       $query = $this->db->prepare("SELECT prefix FROM branch_tbl WHERE id = :bcode");
      
       $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
       $query->execute();        
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function get_userby_id($id)
    {
       
       $query = $this->db->prepare("SELECT staffname FROM user_tbl WHERE id = :id");
      
       $query->bindParam("id", $id, PDO::PARAM_STR);
       $query->execute();        
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function load_service($ivfno)
    {        
        $query = $this->db->prepare("SELECT all__services_tbl.service_name,user_tbl.staffname,ip_daily_order.orderdate,ip_daily_order.ordertime,dept.unitname,ip_daily_order.dept,ip_daily_order.pacode,ip_daily_order.status,ip_daily_order.service_amt,ip_daily_order.doctorname 
        FROM ip_daily_order INNER JOIN dept ON ip_daily_order.dept::integer = dept.id 
        INNER JOIN all__services_tbl ON ip_daily_order.testname::integer = all__services_tbl.id
        INNER JOIN user_tbl ON ip_daily_order.doctorname::integer = user_tbl.id
        WHERE ip_daily_order.visit_number = :ivfno ORDER BY ip_daily_order.id");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function load_service_prn($prn,$lab)
    {        
        $query = $this->db->prepare("SELECT ip_daily_order.id,all__services_tbl.service_name,user_tbl.staffname,ip_daily_order.orderdate,ip_daily_order.ordertime,dept.unitname,ip_daily_order.dept,ip_daily_order.pacode,ip_daily_order.status,ip_daily_order.service_amt,doctorname,
        lab_result.result,lab_result.pdate,lab_result.ptime,lab_result.pby,ip_daily_order.agreed_amt 
        FROM ip_daily_order INNER JOIN dept ON ip_daily_order.dept::integer = dept.id 
        INNER JOIN all__services_tbl ON ip_daily_order.testname::integer = all__services_tbl.id
        INNER JOIN user_tbl ON ip_daily_order.doctorname::integer = user_tbl.id LEFT JOIN
        lab_result ON ip_daily_order.id = lab_result.sri::integer
        WHERE ip_daily_order.prn = :prn AND dept.unitname = :lab ORDER BY ip_daily_order.id DESC");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("lab", $lab, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function lab_services($lab_dept_id,$bcode,$ccode)
    {
       
       $query = $this->db->prepare("SELECT all__services_tbl.id,all__services_tbl.service_name,private_tariff.agreed_amt FROM all__services_tbl 
       INNER JOIN private_tariff ON private_tariff.serviceid::integer = all__services_tbl.id WHERE all__services_tbl.dept = '21' AND private_tariff.bcode = :bcode AND private_tariff.ccode = :ccode ");
      
       $query->bindParam("lab", $lab_dept_id, PDO::PARAM_STR);
       $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
       $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
       $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function rad_services($bcode,$ccode)
    {
       
       $query = $this->db->prepare("SELECT all__services_tbl.id,all__services_tbl.service_name,private_tariff.agreed_amt FROM all__services_tbl 
       INNER JOIN private_tariff ON private_tariff.serviceid::integer = all__services_tbl.id WHERE all__services_tbl.dept = '23' AND private_tariff.bcode = :bcode AND private_tariff.ccode = :ccode ");
       $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
       $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
       $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function fert_services($bcode,$ccode)
    {
       
       $query = $this->db->prepare("SELECT all__services_tbl.id,all__services_tbl.service_name,private_tariff.agreed_amt FROM all__services_tbl 
       INNER JOIN private_tariff ON private_tariff.serviceid::integer = all__services_tbl.id WHERE all__services_tbl.dept = '99' AND private_tariff.bcode = :bcode AND private_tariff.ccode = :ccode ");
       $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
       $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
       $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function tab_drugs($bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT * FROM item__tbl INNER JOIN pharmacy_available_tbl ON item__tbl.id=itemname_id WHERE pharmacy_available_tbl.item_subgroup_id = 7
        AND pharmacy_available_tbl.bcode = :bcode AND pharmacy_available_tbl.ccode = :ccode ");
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
                
    }

    public function get_private_drug($d)
    {
        $query = $this->db->prepare("SELECT * FROM private_drug_tariff WHERE drug_id = :d ORDER BY drug_id DESC LIMIT 1");
        $query->bindParam("d", $d, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function lab_result($id)
    {
        $query = $this->db->prepare("SELECT * FROM lab_result INNER JOIN user_tbl ON 
        pby::integer = user_tbl.id WHERE sri = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function rad_result($id)
    {
        $query = $this->db->prepare("SELECT * FROM rdi_result_tbl INNER JOIN user_tbl ON 
        postedby_id::integer = user_tbl.id INNER JOIN ip_daily_order ON rdi_result_tbl.ip_order_id::integer = ip_daily_order.id 
        WHERE ip_order_id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_insurance_drug($d,$sponsor)
    {
        $query = $this->db->prepare("SELECT * FROM hmo_drug_tariff_tbl WHERE drug_id = :d AND company_id = :sponsor ORDER BY drug_id DESC limit 1");
        $query->bindParam("d", $d, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_corporate_drug($d,$sponsor)
    {
        $query = $this->db->prepare("SELECT * FROM corporate_drug_tariff WHERE drug_id = :d AND company_id = :sponsor ORDER BY drug_id DESC limit 1");
        $query->bindParam("d", $d, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_drug($d)
    {
        $query = $this->db->prepare("SELECT * FROM item__tbl INNER JOIN pharmacy_available_tbl ON item__tbl.id=itemname_id WHERE item__tbl.id = :d");
        $query->bindParam("d", $d, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function liq_drugs($bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT * FROM item__tbl INNER JOIN pharmacy_available_tbl ON item__tbl.id=itemname_id WHERE pharmacy_available_tbl.item_subgroup_id = 6
        AND pharmacy_available_tbl.bcode = :bcode AND pharmacy_available_tbl.ccode = :ccode ");
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
                
    }

    public function con_drugs($bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT * FROM item__tbl INNER JOIN pharmacy_available_tbl ON item__tbl.id=itemname_id WHERE pharmacy_available_tbl.item_subgroup_id = 8
        AND pharmacy_available_tbl.bcode = :bcode AND pharmacy_available_tbl.ccode = :ccode ");
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
                
    }

    public function private_drug1($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id,$cost,$sales,$qty1,$dept,$payment_status,$trans_status,$staffname,$bcode,
    $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt1,$source1){

        if (!empty($drug_id)){

        $query = $this->db->prepare("INSERT INTO pay_now_transactions(visitdate,ordertime,prn,patient_type,items,cost,agreed_amt,qty,dept,payment_status,trans_status,postedby,bcode,ccode,service_category_id,subunit_id,tstamp,specialty_id,visit_number,post_status,total,source_tbl_id) 
        VALUES (:orderdate,:ordertime,:prn,:category,:testname,:hospital_amt::money,:agreed_amt::money,:qty,:dept,:payment_status,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:unit,:timestamp,:specialty_id,:vsn,:post_status,:total,:source)");
        $query->bindParam("orderdate", $pt_date, PDO::PARAM_STR);
        $query->bindParam("ordertime", $pt_time, PDO::PARAM_STR);
        $query->bindParam("prn", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("unit", $subunit_id, PDO::PARAM_STR);
        $query->bindParam("testname", $drug_id, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("qty", $qty1, PDO::PARAM_STR);
        $query->bindParam("category", $pat_cat, PDO::PARAM_STR);
        //$query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);        
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $staffname, PDO::PARAM_STR);
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $cost, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $sales, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_category_id, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        $query->bindParam("total", $totamt1, PDO::PARAM_STR);
        $query->bindParam("source", $source1, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
        }
    }

    public function private_drug2($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id2,$cost2,$sales2,$qty2,$dept,$payment_status,$trans_status,$staffname,$bcode,
    $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt2,$source2){

        if (!empty($drug_id2)){

        $query = $this->db->prepare("INSERT INTO pay_now_transactions(visitdate,ordertime,prn,patient_type,items,cost,agreed_amt,qty,dept,payment_status,trans_status,postedby,bcode,ccode,service_category_id,subunit_id,tstamp,specialty_id,visit_number,post_status,total,source_tbl_id) 
        VALUES (:orderdate,:ordertime,:prn,:category,:testname,:hospital_amt::money,:agreed_amt::money,:qty,:dept,:payment_status,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:unit,:timestamp,:specialty_id,:vsn,:post_status,:total,:source)");
        $query->bindParam("orderdate", $pt_date, PDO::PARAM_STR);
        $query->bindParam("ordertime", $pt_time, PDO::PARAM_STR);
        $query->bindParam("prn", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("unit", $subunit_id, PDO::PARAM_STR);
        $query->bindParam("testname", $drug_id2, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("qty", $qty2, PDO::PARAM_STR);
        $query->bindParam("category", $pat_cat, PDO::PARAM_STR);
        //$query->bindParam("sponsor", $sponsor, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);        
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $staffname, PDO::PARAM_STR);
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $cost2, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $sales2, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_category_id, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        $query->bindParam("total", $totamt2, PDO::PARAM_STR);
        $query->bindParam("source", $source2, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
        }
    }

    public function family_drug1($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id,$cost,$sales,$qty1,$dept,$payment_status,$trans_status,$staffname,$bcode,
    $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt1,$sponsorid,$source1){

        if (!empty($drug_id)){

        $query = $this->db->prepare("INSERT INTO family_transactions(visitdate,ordertime,prn,patient_type,items,cost,agreed_amt,qty,dept,payment_status,trans_status,postedby,bcode,ccode,service_category_id,subunit_id,tstamp,specialty_id,visit_number,post_status,total,family_sponsor_id,source_tbl_id) 
        VALUES (:orderdate,:ordertime,:prn,:category,:testname,:hospital_amt::money,:agreed_amt::money,:qty,:dept,:payment_status,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:unit,:timestamp,:specialty_id,:vsn,:post_status,:total,:sponsor,:source)");
        $query->bindParam("orderdate", $pt_date, PDO::PARAM_STR);
        $query->bindParam("ordertime", $pt_time, PDO::PARAM_STR);
        $query->bindParam("prn", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("unit", $subunit_id, PDO::PARAM_STR);
        $query->bindParam("testname", $drug_id, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("qty", $qty1, PDO::PARAM_STR);
        $query->bindParam("category", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);        
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $staffname, PDO::PARAM_STR);
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $cost, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $sales, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_category_id, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        $query->bindParam("total", $totamt1, PDO::PARAM_STR);
        $query->bindParam("source", $source1, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
        
        }
    }

    public function family_drug2($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id2,$cost2,$sales2,$qty2,$dept,$payment_status,$trans_status,$staffname,$bcode,
    $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt2,$sponsorid,$source2){

        if (!empty($drug_id2)){

        $query = $this->db->prepare("INSERT INTO family_transactions(visitdate,ordertime,prn,patient_type,items,cost,agreed_amt,qty,dept,payment_status,trans_status,postedby,bcode,ccode,service_category_id,subunit_id,tstamp,specialty_id,visit_number,post_status,total,family_sponsor_id,source_tbl_id) 
        VALUES (:orderdate,:ordertime,:prn,:category,:testname,:hospital_amt::money,:agreed_amt::money,:qty,:dept,:payment_status,:trans_status,:doctorname,:bcode,:ccode,:service_cat_id,:unit,:timestamp,:specialty_id,:vsn,:post_status,:total,:sponsor,:source)");
        $query->bindParam("orderdate", $pt_date, PDO::PARAM_STR);
        $query->bindParam("ordertime", $pt_time, PDO::PARAM_STR);
        $query->bindParam("prn", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("unit", $subunit_id, PDO::PARAM_STR);
        $query->bindParam("testname", $drug_id2, PDO::PARAM_STR);
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("qty", $qty2, PDO::PARAM_STR);
        $query->bindParam("category", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);        
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        //$query->bindParam("service_amt", $service_amt, PDO::PARAM_STR);
        $query->bindParam("doctorname", $staffname, PDO::PARAM_STR);
        //$query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("hospital_amt", $cost2, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $sales2, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_category_id, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        $query->bindParam("total", $totamt2, PDO::PARAM_STR);
        $query->bindParam("source", $source2, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
        }
    }

    public function paylater_drug1($pt_date,$pt_time,$prn_drug,$drug_id,$cost,$sales,$agreed_amt1,$qty1,$dept,$trans_status,$staffname,$bcode,$ccode,
    $pat_cat,$service_category_id,$sponsorid,$specialty_id,$vsn,$totamt1,$status,$cap_status,$payment_status,$subunit_id,$pacode,$source1){
        
        if (!empty($drug_id)){

        $query = $this->db->prepare("INSERT INTO pay_later_transaction_tbl(visitdate,ordertime,prn,items,qty,dept,trans_status,postedby,bcode,ccode,pat_category,service_category_id,sponsorid,specialty_id,visit_number,status,cap_status,pacode,sub_unit_id,payment_status,tstamp,source_tbl_id,tot_amt,agreed_amt,private_amt,cost) 
        VALUES (:orderdate,:ordertime,:prn,:testname,:qty,:dept,:trans_status,:doctorname,:bcode,:ccode,:category,:service_cat_id,:sponsor,:specialty_id,:vsn,:status,:cap_status,:pacode,:unit,:payment_status,:timestamp,:source,:total,:agreed_amt,:private_amt,:hospital_amt)");
        $query->bindParam("orderdate", $pt_date, PDO::PARAM_STR);
        $query->bindParam("ordertime", $pt_time, PDO::PARAM_STR);
        $query->bindParam("prn", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("testname", $drug_id, PDO::PARAM_STR);
        
        $query->bindParam("hospital_amt", $cost, PDO::PARAM_STR);
        $query->bindParam("private_amt", $sales, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $agreed_amt1, PDO::PARAM_STR);
        $query->bindParam("qty", $qty1, PDO::PARAM_STR);        
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        $query->bindParam("doctorname", $staffname, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("category", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_category_id, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("total", $totamt1, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("cap_status", $cap_status, PDO::PARAM_STR);
        $query->bindParam("pacode", $pacode, PDO::PARAM_STR);
        $query->bindParam("unit", $subunit_id, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("source", $source1, PDO::PARAM_STR);   
                
        //$query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();
        }
    }
    

    public function paylater_drug2($pt_date,$pt_time,$prn_drug,$drug_id2,$cost2,$sales2,$agreed_amt2,$qty2,$dept,$trans_status,$staffname,$bcode,$ccode,
    $pat_cat,$service_category_id,$sponsorid,$specialty_id,$vsn,$totamt2,$status,$cap_status,$payment_status,$subunit_id,$pacode2,$source2){

        if (!empty($drug_id2)){
            
        $query = $this->db->prepare("INSERT INTO pay_later_transaction_tbl(visitdate,ordertime,prn,items,qty,dept,trans_status,postedby,bcode,ccode,pat_category,service_category_id,sponsorid,specialty_id,visit_number,status,cap_status,pacode,sub_unit_id,payment_status,tstamp,source_tbl_id,tot_amt,agreed_amt,private_amt,cost) 
        VALUES (:orderdate,:ordertime,:prn,:testname,:qty,:dept,:trans_status,:doctorname,:bcode,:ccode,:category,:service_cat_id,:sponsor,:specialty_id,:vsn,:status,:cap_status,:pacode,:unit,:payment_status,:timestamp,:source,:total,:agreed_amt,:private_amt,:hospital_amt)");
        $query->bindParam("orderdate", $pt_date, PDO::PARAM_STR);
        $query->bindParam("ordertime", $pt_time, PDO::PARAM_STR);
        $query->bindParam("prn", $prn_drug, PDO::PARAM_STR);
        $query->bindParam("testname", $drug_id2, PDO::PARAM_STR);
        
        $query->bindParam("hospital_amt", $cost2, PDO::PARAM_STR);
        $query->bindParam("private_amt", $sales2, PDO::PARAM_STR);
        $query->bindParam("agreed_amt", $agreed_amt2, PDO::PARAM_STR);
        $query->bindParam("qty", $qty2, PDO::PARAM_STR);        
        $query->bindParam("dept", $dept, PDO::PARAM_STR);
        $query->bindParam("trans_status", $trans_status, PDO::PARAM_STR);
        $query->bindParam("doctorname", $staffname, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("category", $pat_cat, PDO::PARAM_STR);
        $query->bindParam("service_cat_id", $service_category_id, PDO::PARAM_STR);
        $query->bindParam("sponsor", $sponsorid, PDO::PARAM_STR);
        $query->bindParam("specialty_id", $specialty_id, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        $query->bindParam("total", $totamt2, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("cap_status", $cap_status, PDO::PARAM_STR);
        $query->bindParam("pacode", $pacode2, PDO::PARAM_STR);
        $query->bindParam("unit", $subunit_id, PDO::PARAM_STR);
        $query->bindParam("payment_status", $payment_status, PDO::PARAM_STR);
        $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
        $query->bindParam("source", $source2, PDO::PARAM_STR);   
                
        //$query->bindParam("post_status", $post_status, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();
     }
    }

    public function get_ivf_deposit($prn)
    {
        $query = $this->db->prepare("SELECT SUM(amt_deposited) FROM ivf_deposit_tbl WHERE prn = :prn AND status IS NULL ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function get_ivf_spent($prn)
    {
        $query = $this->db->prepare("SELECT amt_used FROM ivf_deposit_tbl WHERE prn = :prn AND status IS NULL ORDER BY id DESC LIMIT 1 ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function put_spent($prn,$deduct)
    {
        $query = $this->db->prepare("UPDATE ivf_deposit_tbl SET amt_used = :deduct::money WHERE prn = :prn AND status IS NULL");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("deduct", $deduct, PDO::PARAM_STR);
        $query->execute();        
        
                
    }

    public function check_ivf_reg($prn)
    {
        $query = $this->db->prepare("SELECT count(*) FROM fert_pat WHERE prn = :prn AND status = 'OPEN' ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function remove_registered($id)
    {
        $query = $this->db->prepare("DELETE FROM daily_visit_tbl WHERE id = :id::integer ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
         
                
    }

    public function delete_drug($id)
    {
        $query = $this->db->prepare("DELETE FROM prescription_tbl WHERE id = :id::integer ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
         
                
    }

    public function delete_service($id)
    {
        $query = $this->db->prepare("DELETE FROM ip_daily_order WHERE id = :id::integer ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
         
                
    }

    public function delete_service_trans($id)
    {
        $query = $this->db->prepare("DELETE FROM pay_later_transaction_tbl WHERE source_tbl_id = :id::integer ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
         
                
    }

    public function drug_cost_deduct($id)
    {
        $query = $this->db->prepare("SELECT totamt FROM prescription_tbl WHERE id = :id ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function service_cost_deduct($id)
    {
        $query = $this->db->prepare("SELECT agreed_amt FROM ip_daily_order WHERE id = :id ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function ivf_pattype()
    {
        $query = $this->db->prepare("SELECT id FROM patient_type_tbl WHERE ptype = 'FER' ");
        //$query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function pat_name_prn($prn)
    {
        $query = $this->db->prepare("SELECT * FROM patient_records_tbl WHERE prn = :prn ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

        
    public function revert_toacc($prn,$new_amt)
    {
        $query = $this->db->prepare("UPDATE ivf_deposit_tbl SET amt_used = :new_amt WHERE prn = :prn AND status IS NULL");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("new_amt", $new_amt, PDO::PARAM_STR);
        $query->execute();        
        
                
    }

    public function reg_donor($prn,$bcode,$ccode,$status,$date,$time,$by,$vsn)
    {
        
            $query = $this->db->prepare("INSERT INTO ivf_donor_tbl(prn,bcode,ccode,date,time,status,by,visitno) 
        VALUES (:prn,:bcode,:ccode,:date,:time,:status,:by,:vsn)");
        
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("date", $date, PDO::PARAM_STR);
        $query->bindParam("time", $time, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("by", $by, PDO::PARAM_STR);
        $query->bindParam("vsn", $vsn, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();
        
    }

    public function check_donor($prn)
    {
        $query = $this->db->prepare("SELECT count(*) FROM ivf_donor_tbl WHERE prn = :prn AND status = 'OPEN' ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function convert_donor_pat($id)
    {
        $query = $this->db->prepare("UPDATE ivf_donor_tbl SET status = 'REG' WHERE id = :id ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
       // $query->bindParam("deduct", $deduct, PDO::PARAM_STR);
        $query->execute();        
        
                
    }

    public function accept_referral($id)
    {
        $query = $this->db->prepare("UPDATE ivf_referral_tbl SET status = 'accepted' WHERE id = :id ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
       // $query->bindParam("deduct", $deduct, PDO::PARAM_STR);
        $query->execute();        
        
                
    }

    public function referral_list($status,$bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT ivf_referral_tbl.id,ivf_referral_tbl.date,ivf_referral_tbl.time,
        ivf_referral_tbl.prn,patient_records_tbl.fullname,patient_records_tbl.gender,patient_records_tbl.marital_status,
        patient_records_tbl.dob,patient_records_tbl.phoneno,user_tbl.staffname,patient_category_tbl.category 
        FROM ivf_referral_tbl INNER JOIN patient_records_tbl ON
        ivf_referral_tbl.prn = patient_records_tbl.prn INNER JOIN user_tbl ON ivf_referral_tbl.by::integer = user_tbl.id
        INNER JOIN patient_category_tbl ON patient_records_tbl.category::integer = patient_category_tbl.id
        WHERE ivf_referral_tbl.status = :status AND ivf_referral_tbl.bcode = :bcode AND ivf_referral_tbl.ccode = :ccode ");
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data; 
                
    }

    public function referred_pat_details($prn)
    {
        $query = $this->db->prepare("SELECT * FROM ivf_referral_tbl INNER JOIN patient_records_tbl ON
        ivf_referral_tbl.prn = patient_records_tbl.prn INNER JOIN user_tbl ON ivf_referral_tbl.by::integer = user_tbl.id
        INNER JOIN patient_category_tbl ON patient_records_tbl.category::integer = patient_category_tbl.id
        LEFT JOIN corporate_client_tbl ON patient_records_tbl.sponsor::integer = corporate_client_tbl.id
        WHERE ivf_referral_tbl.prn = :prn ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function existing_ivf_count()
    {
       $query = $this->db->prepare("SELECT count(*) FROM fert_pat     
       WHERE fert_pat.status = 'OPEN' ");
       //$query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);

       $query->execute();
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function ivf_donor_count()
    {
       $query = $this->db->prepare("SELECT count(*) FROM ivf_donor_tbl  
       WHERE ivf_donor_tbl.status = 'OPEN' ");
       //$query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);

       $query->execute();
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function ivf_waiting_count($pay_status,$bcode,$ccode)
    {
       $query = $this->db->prepare("SELECT count(*) FROM daily_visit_tbl  WHERE 
       payment_status = :pay_status AND daily_visit_tbl.bcode = :bcode AND daily_visit_tbl.ccode = :ccode AND daily_visit_tbl.status IS NULL ");
       $query->bindParam("pay_status", $pay_status, PDO::PARAM_STR);
       $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
       $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
       $query->execute();
       return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function referral_list_count($status,$bcode,$ccode)
    {
        $query = $this->db->prepare("SELECT count(*)FROM ivf_referral_tbl 
        WHERE ivf_referral_tbl.status = :status AND ivf_referral_tbl.bcode = :bcode AND ivf_referral_tbl.ccode = :ccode ");
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function check_ivf_acc()
    {
        
        $query = $this->db->prepare("SELECT * FROM patient_records_tbl
         WHERE prn IN (SELECT DISTINCT(prn) FROM ivf_deposit_tbl WHERE status IS NULL) ");
        //$query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function details_ivf_acc($prn)
    {
        
        $query = $this->db->prepare("SELECT * FROM ivf_deposit_tbl INNER JOIN patient_records_tbl ON
        ivf_deposit_tbl.prn = patient_records_tbl.prn INNER JOIN branch_tbl ON ivf_deposit_tbl.bcode::integer = branch_tbl.id 
        WHERE ivf_deposit_tbl.prn = :prn ");
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function sperm_pre_prep($hs,$ds,$fs,$method_collection,$abstinence,$time_produced,$time_delivered,$time_assessed,
    $volume,$viscosity,$liquefaction,$conc_count,$motile_count,$motility,$total_count,$agglutination,$instrument_used,
    $comment,$embryologist,$ivfno,$bcode,$ccode,$date,$time)
    {
        
            $query = $this->db->prepare("INSERT INTO sperm_pre_prep(ivfno,hs,ds,fs,method_collection,abstinence,time_produced,time_delivered,
            time_assessed,volume,viscosity,liquefaction,conc,motile,motility,total_count,agglutination,instrument_used,comment,embryologist,
            bcode,ccode,status,date,time) 
        VALUES (:ivfno,:hs,:ds,:fs,:method_collection,:abstinence,:time_produced,:time_delivered,:time_assessed,:volume,:viscosity,:liquefaction,
        :conc,:motile,:motility,:total_count,:agglutination,:instrument_used,:comment,:embryologist,:bcode,:ccode,:status,:date,:time)");
        
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->bindParam("hs", $hs, PDO::PARAM_STR);
        $query->bindParam("ds", $ds, PDO::PARAM_STR);
        $query->bindParam("fs", $fs, PDO::PARAM_STR);
        $query->bindParam("method_collection", $method_collection, PDO::PARAM_STR);
        $query->bindParam("abstinence", $abstinence, PDO::PARAM_STR);
        $query->bindParam("time_produced", $time_produced, PDO::PARAM_STR);
        $query->bindParam("time_delivered", $time_delivered, PDO::PARAM_STR);
        $query->bindParam("time_assessed", $time_assesed, PDO::PARAM_STR);
        $query->bindParam("volume", $volume, PDO::PARAM_STR);
        $query->bindParam("viscosity", $viscosity, PDO::PARAM_STR);
        $query->bindParam("liquefaction", $liquefaction, PDO::PARAM_STR);
        $query->bindParam("conc", $conc, PDO::PARAM_STR);
        $query->bindParam("motile", $motile, PDO::PARAM_STR);
        $query->bindParam("motility", $motility, PDO::PARAM_STR);
        $query->bindParam("total_count", $total_count, PDO::PARAM_STR);
        $query->bindParam("agglutination", $agglutination, PDO::PARAM_STR);
        $query->bindParam("instrument_used", $instrument_used, PDO::PARAM_STR);
        $query->bindParam("comment", $comment, PDO::PARAM_STR);
        $query->bindParam("embryologist", $embryologist, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->bindParam("date", $date, PDO::PARAM_STR);
        $query->bindParam("time", $time, PDO::PARAM_STR);
        
        $query->execute();
        return $this->db->lastInsertId();
        
    }

    public function select_spp($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM sperm_pre_prep 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function select_spostp($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM sperm_post_prep 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function select_eggd($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM egg_details 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }
    
     public function sperm_post_prep($time_assessed,$prep_time,$prep_method,$vol_assessed,$motile_count,$motile_rapid,
     $motile_slow,$comment,$embryologist,$ivfno,$bcode,$ccode,$date,$time)
     {
         
             $query = $this->db->prepare("INSERT INTO sperm_post_prep(date,time,ivfno,time_assessed,prep_time,prep_method,
             vol_assessed,motile_count,motile_rapid,motile_slow,embryologist,comment,bcode,ccode) 
         VALUES (:date,:time,:ivfno,:time_assessed,:prep_time,:prep_method,:vol_assessed,:motile_count,:motile_rapid,:motile_slow,
         :embryologist,:comment,:bcode,:ccode)");
         
         $query->bindParam("date", $date, PDO::PARAM_STR);
         $query->bindParam("time", $time, PDO::PARAM_STR);
         $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
         $query->bindParam("time_assessed", $time_assessed, PDO::PARAM_STR);
         $query->bindParam("prep_time", $prep_time, PDO::PARAM_STR);
         $query->bindParam("prep_method", $prep_method, PDO::PARAM_STR);
         $query->bindParam("vol_assessed", $vol_assessed, PDO::PARAM_STR);
         $query->bindParam("motile_count", $motile_count, PDO::PARAM_STR);
         $query->bindParam("motile_rapid", $motile_rapid, PDO::PARAM_STR);
         $query->bindParam("motile_slow", $motile_slow, PDO::PARAM_STR);
         $query->bindParam("embryologist", $embryologist, PDO::PARAM_STR);
         $query->bindParam("comment", $comment, PDO::PARAM_STR);
         $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
         $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
         
         $query->execute();
         return $this->db->lastInsertId();
         
     }

     public function egg_details($egg_time,$lt_ovary,$rt_ovary,$egg,$time_of_insemination,$oocytes,$oocytes_treated,
     $treatment_mode,$stripped_by,$ocr_by,$inseminated_by,$comment,$media_used,$bcode,$ccode,$ivfno,$date,$ptime,$posted_by)
     {
         
             $query = $this->db->prepare("INSERT INTO egg_details(egg_time,lt_ovary,rt_ovary,egg,time_of_insemination,oocytes,
             oocytes_treated,treatment_mode,stripped_by,ocr_by,inseminated_by,comment,media_used,bcode,ccode,ivfno,date,ptime,posted_by) 
         VALUES (:egg_time,:lt_ovary,:rt_ovary,:egg,:time_of_insemination,:oocytes,:oocytes_treated,:treatment_mode,
         :stripped_by,:ocr_by,:inseminated_by,:comment,:media_used,:bcode,:ccode,:ivfno,:date,:ptime,:posted_by)");
         
         $query->bindParam("egg_time", $egg_time, PDO::PARAM_STR);
         $query->bindParam("lt_ovary", $lt_ovary, PDO::PARAM_STR);
         $query->bindParam("rt_ovary", $rt_ovary, PDO::PARAM_STR);
         $query->bindParam("egg", $egg, PDO::PARAM_STR);
         $query->bindParam("time_of_insemination", $time_of_insemination, PDO::PARAM_STR);
         $query->bindParam("oocytes", $oocytes, PDO::PARAM_STR);
         $query->bindParam("oocytes_treated", $oocytes_treated, PDO::PARAM_STR);
         $query->bindParam("treatment_mode", $treatment_mode, PDO::PARAM_STR);
         $query->bindParam("stripped_by", $stripped_by, PDO::PARAM_STR);
         $query->bindParam("ocr_by", $ocr_by, PDO::PARAM_STR);
         $query->bindParam("inseminated_by", $inseminated_by, PDO::PARAM_STR);
         $query->bindParam("comment", $comment, PDO::PARAM_STR);
         $query->bindParam("media_used", $media_used, PDO::PARAM_STR);
         $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
         $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
         $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
         $query->bindParam("date", $date, PDO::PARAM_STR);
         $query->bindParam("ptime", $ptime, PDO::PARAM_STR);
         $query->bindParam("posted_by", $posted_by, PDO::PARAM_STR);
         
         $query->execute();
         return $this->db->lastInsertId();
         
     }

     public function pn_check($ctime,$cumm_break_down,$fertilized,$grades,$embryologist,$comment,$bcode,$ccode,$ivfno,$date,
     $ptime,$posted_by)
     {
         
             $query = $this->db->prepare("INSERT INTO pn_check(ctime,cumm_break_down,fertilized,grades,embryologist,comment,bcode,ccode,date,time,posted_by,ivfno) 
         VALUES (:ctime,:cumm_break_down,:fertilized,:grades,:embryologist,:comment,:bcode,:ccode,:date,:time,:posted_by,:ivfno)");
         
         $query->bindParam("ctime", $ctime, PDO::PARAM_STR);
         $query->bindParam("cumm_break_down", $cumm_break_down, PDO::PARAM_STR);
         $query->bindParam("fertilized", $fertilized, PDO::PARAM_STR);
         $query->bindParam("grades", $grades, PDO::PARAM_STR);
         $query->bindParam("embryologist", $embryologist, PDO::PARAM_STR);
         $query->bindParam("comment", $comment, PDO::PARAM_STR);
         $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
         $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
         $query->bindParam("date", $date, PDO::PARAM_STR);
         $query->bindParam("time", $ptime, PDO::PARAM_STR);
         $query->bindParam("posted_by", $posted_by, PDO::PARAM_STR);
         $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
                  
         $query->execute();
         return $this->db->lastInsertId();
         
     }

     public function grading($day,$gtime,$cleaved,$failed_cleave,$embryo_grade,$embryologist,$comment,
     $bcode,$ccode,$ivfno,$date,$ptime,$posted_by)
     {
         
             $query = $this->db->prepare("INSERT INTO grading(day,gtime,cleaved,failed_cleave,embryo_grade,embryologist,comment,bcode,ccode,ivfno,date,time,posted_by) 
         VALUES (:day,:gtime,:cleaved,:failed_cleave,:embryo_grade,:embryologist,:comment,:bcode,:ccode,:ivfno,:date,:ptime,:posted_by)");
         
         $query->bindParam("day", $day, PDO::PARAM_STR);
         $query->bindParam("gtime", $gtime, PDO::PARAM_STR);
         $query->bindParam("cleaved", $cleaved, PDO::PARAM_STR);
         $query->bindParam("failed_cleave", $failed_cleave, PDO::PARAM_STR);
         $query->bindParam("embryo_grade", $embryo_grade, PDO::PARAM_STR);
         $query->bindParam("embryologist", $embryologist, PDO::PARAM_STR);
         $query->bindParam("comment", $comment, PDO::PARAM_STR);
         $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
         $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
         $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
         $query->bindParam("date", $date, PDO::PARAM_STR);
         $query->bindParam("ptime", $ptime, PDO::PARAM_STR);
         $query->bindParam("posted_by", $posted_by, PDO::PARAM_STR);
                  
         $query->execute();
         return $this->db->lastInsertId();
         
     }

     public function embryo_transfer($transfer_time,$transfer_day,$embryo_transferred,$stylet,$grade_transferred_embryo,
     $volume,$viscosity,$liquefaction_time,$conc_count,$motile_count,$motility,$total_count,$agglutination,
     $instrument_used,$comment,$embryologist,$bcode,$ccode,$ivfno,$date,$ptime,$posted_by)
     {
         
             $query = $this->db->prepare("INSERT INTO embryo_transfer(transfer_time,transfer_day,embryo_transferred,stylet,grade_transferred_embryo,
             volume,viscosity,liquefaction_time,conc_count,motile_count,motility,total_count,agglutination,instrument_used,comment,embryologist,
             bcode,ccode,ivfno,date,time,posted_by) 
         VALUES (:transfer_time,:transfer_day,:embryo_transferred,:stylet,:grade_transferred_embryo,:volume,:viscosity,:liquefaction_time,
         :conc_count,:motile_count,:motility,:total_count,:agglutination,:instrument_used,:comment,:embryologist,:bcode,:ccode,:ivfno,:date,:time,:posted_by)");
         
         $query->bindParam("transfer_time", $transfer_time, PDO::PARAM_STR);
         $query->bindParam("transfer_day", $transfer_day, PDO::PARAM_STR);
         $query->bindParam("embryo_transferred", $embryo_transferred, PDO::PARAM_STR);
         $query->bindParam("stylet", $stylet, PDO::PARAM_STR);
         $query->bindParam("grade_transferred_embryo", $grade_transferred_embryo, PDO::PARAM_STR);
         $query->bindParam("volume", $volume, PDO::PARAM_STR);
         $query->bindParam("viscosity", $viscosity, PDO::PARAM_STR);
         $query->bindParam("liquefaction_time", $liquefaction_time, PDO::PARAM_STR);
         $query->bindParam("conc_count", $conc_count, PDO::PARAM_STR);
         $query->bindParam("motile_count", $motile_count, PDO::PARAM_STR);
         $query->bindParam("motility", $motility, PDO::PARAM_STR);
         $query->bindParam("total_count", $total_count, PDO::PARAM_STR);
         $query->bindParam("agglutination", $agglutination, PDO::PARAM_STR);
         $query->bindParam("instrument_used", $instrument_used, PDO::PARAM_STR);
         $query->bindParam("comment", $comment, PDO::PARAM_STR);
         $query->bindParam("embryologist", $embryologist, PDO::PARAM_STR);
         $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
         $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
         $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
         $query->bindParam("date", $date, PDO::PARAM_STR);
         $query->bindParam("time", $ptime, PDO::PARAM_STR);
         $query->bindParam("posted_by", $posted_by, PDO::PARAM_STR);
         
         $query->execute();
         return $this->db->lastInsertId();
         
     }

     public function treatment_outcome($pt,$test_date,$pregnancy_outcome,$scan_confirmation,$delivery_date,$live_birth,
     $posted_by,$ivfno,$bcode,$ccode,$date,$time,$to_date,$comment)
     {
         
             $query = $this->db->prepare("INSERT INTO treatment_outcome(pt,test_date,pregnancy_outcome,scan_confirmation,live_birth,
             ivfno,bcode,ccode,posted_by,date,time,comment,del_date,treatment_outcome_date) 
         VALUES (:pt,:test_date,:pregnancy_outcome,:scan_confirmation,:live_birth,:ivfno,:bcode,:ccode,:posted_by,:date,:time,:comment,:delivery_date,:to_date)");
         
         $query->bindParam("pt", $pt, PDO::PARAM_STR);
         $query->bindParam("test_date", $test_date, PDO::PARAM_STR);
         $query->bindParam("pregnancy_outcome", $pregnancy_outcome, PDO::PARAM_STR);
         $query->bindParam("scan_confirmation", $scan_confirmation, PDO::PARAM_STR);
         $query->bindParam("delivery_date", $delivery_date, PDO::PARAM_STR);
         $query->bindParam("live_birth", $live_birth, PDO::PARAM_STR);
         $query->bindParam("posted_by", $posted_by, PDO::PARAM_STR);
         $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
         $query->bindParam("comment", $comment, PDO::PARAM_STR);
         $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
         $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
         
         $query->bindParam("date", $date, PDO::PARAM_STR);
         $query->bindParam("time", $time, PDO::PARAM_STR);
         $query->bindParam("to_date", $to_date, PDO::PARAM_STR);
         
         
         $query->execute();
         return $this->db->lastInsertId();
         
     }

     public function submit_counsel($name,$dob,$address,$complexion,$afc,$lmp,$blood_group,$w_phone,$h_phone,$email,
     $referral,$type,$noc,$sign,$by,$bcode,$ccode,$date,$time)
    {
        
            $query = $this->db->prepare("INSERT INTO ivf_counselling(date,time,name,dob,address,complexion,afc,lmp,
            blood_group,w_no,h_no,email,referral,client_type,no_of_children,sign,by,bcode,ccode) 
        VALUES (:date,:time,:name,:dob,:address,:complexion,:afc,:lmp,:blood_group,:w_phone,:h_phone,:email,:referral,
        :type,:noc,:sign,:by,:bcode,:ccode)");
        $query->bindParam("date", $date, PDO::PARAM_STR);
        $query->bindParam("time", $time, PDO::PARAM_STR);
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("dob", $dob, PDO::PARAM_STR);
        $query->bindParam("address", $address, PDO::PARAM_STR);
        $query->bindParam("complexion", $complexion, PDO::PARAM_STR);
        $query->bindParam("afc", $afc, PDO::PARAM_STR);
        $query->bindParam("lmp", $lmp, PDO::PARAM_STR);
        $query->bindParam("blood_group", $blood_group, PDO::PARAM_STR);
        $query->bindParam("w_phone", $w_phone, PDO::PARAM_STR);
        $query->bindParam("h_phone", $h_phone, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("referral", $referral, PDO::PARAM_STR);
        $query->bindParam("type", $type, PDO::PARAM_STR);
        $query->bindParam("noc", $noc, PDO::PARAM_STR);
        $query->bindParam("sign", $sign, PDO::PARAM_STR);
        $query->bindParam("by", $by, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
                
        $query->execute();
        return $this->db->lastInsertId();
        
    }

    public function get_counsel($id)
    {
        $query = $this->db->prepare("SELECT * FROM ivf_counselling WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC); 
                
    }

    public function update_counsel($name,$dob,$address,$complexion,$afc,$lmp,$blood_group,$w_phone,$h_phone,$email,
                                    $referral,$type,$noc,$sign,$by,$id)
    {
        $query = $this->db->prepare("UPDATE ivf_counselling SET name = :name,dob=:dob,address=:address,
        complexion = :complexion,afc = :afc,lmp = :lmp,blood_group = :blood_group,w_no = :w_p,h_no = :h_p,
        email = :email,referral = :ref,client_type = :type,no_of_children = :noc,sign = :sign WHERE id = :id ");
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("dob", $dob, PDO::PARAM_STR);
        $query->bindParam("address", $address, PDO::PARAM_STR);
        $query->bindParam("complexion", $complexion, PDO::PARAM_STR);
        $query->bindParam("afc", $afc, PDO::PARAM_STR);
        $query->bindParam("lmp", $lmp, PDO::PARAM_STR);
        $query->bindParam("blood_group", $blood_group, PDO::PARAM_STR);
        $query->bindParam("w_p", $w_phone, PDO::PARAM_STR);
        $query->bindParam("h_p", $h_phone, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("ref", $referral, PDO::PARAM_STR);
        $query->bindParam("type", $type, PDO::PARAM_STR);
        $query->bindParam("noc", $noc, PDO::PARAM_STR);
        $query->bindParam("sign", $sign, PDO::PARAM_STR);
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
        
                
    }

    public function delete_counsel($id)
    {
        $query = $this->db->prepare("UPDATE ivf_counselling SET status = 'DELETED' WHERE id = :id::integer ");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();        
         
                
    }

    public function submit_prescription_entry($inj,$dosage,$scan_days,$scan_findings,$remark,$bcode,$ccode,$by,
    $prn,$ivfno,$date,$time)
    {
        
            $query = $this->db->prepare("INSERT INTO ivf_prescription(ivfno,prn,date,time,inj,dosage,scan_days,scan_findings,
            remark,posted_by,bcode,ccode) 
        VALUES (:ivfno,:prn,:date,:time,:inj,:dosage,:scan_days,:scan_findings,:remark,:posted_by,:bcode,:ccode)");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->bindParam("prn", $prn, PDO::PARAM_STR);
        $query->bindParam("date", $date, PDO::PARAM_STR);
        $query->bindParam("time", $time, PDO::PARAM_STR);
        $query->bindParam("inj", $inj, PDO::PARAM_STR);
        $query->bindParam("dosage", $dosage, PDO::PARAM_STR);
        $query->bindParam("scan_days", $scan_days, PDO::PARAM_STR);
        $query->bindParam("scan_findings", $scan_findings, PDO::PARAM_STR);
        $query->bindParam("remark", $remark, PDO::PARAM_STR);
        $query->bindParam("posted_by", $by, PDO::PARAM_STR);
        $query->bindParam("bcode", $bcode, PDO::PARAM_STR);
        $query->bindParam("ccode", $ccode, PDO::PARAM_STR);
                        
        $query->execute();
        return $this->db->lastInsertId();
        
    }

    public function prescription($ivfno)
    {
        
        $query = $this->db->prepare("SELECT * FROM ivf_prescription INNER JOIN user_tbl ON
        user_tbl.id = ivf_prescription.posted_by::integer 
        WHERE ivf_prescription.ivfno = :ivfno ");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function select_pncheck($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM pn_check 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function load_grade($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM grading 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function load_embryo_transfer($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM embryo_transfer 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    public function select_outcome($ivfno)
    {
        $query = $this->db->prepare("SELECT * FROM treatment_outcome 
        WHERE ivfno = :ivfno ORDER BY id DESC LIMIT 1");
        $query->bindParam("ivfno", $ivfno, PDO::PARAM_STR);
        
        $query->execute();        
        return $query->fetch(PDO::FETCH_ASSOC);
                
    }

    function __destruct()
    {
        $this->db = null;
    }



}

/*router*/

/*$('#bb').click(function(){
    $('#router').load('register_patient?prn=PRN-WR1938');
    });

    
    $('#frontdesk_posting').click(function(){
        $('#router').load('fd_posting_ivf');
        });
*/
    

   
        





$('#submit').click(function(){
    var wife_name = $('#w_n').val();
    var husband_name = $('#h_n').val();
    var husband_age = $('#h_a').val();
    var wife_age = $('#w_a').val();
    var husband_occ = $('#h_o').val();
    var wife_occ = $('#w_o').val();
    var address = $('#add').val();
    var husband_ph = $('#h_ph').val();
    var wife_ph = $('#w_ph').val();
    var ref_hosp = $('#ref_hos').val();
    var marital_stat = $('#mar_stat').val();
    var infertility_type = $('#type_infertility').val();    
    var htn = $('#htn').is(':checked')?'YES':'NO';    
    var tb = $('#tb').is(':checked')?'YES':'NO';
    var dm = $('#dm').is(':checked')?'YES':'NO';
    var asth = $('#asth').is(':checked')?'YES':'NO';
    var hd = $('#hd').is(':checked')?'YES':'NO';
    var allergy = $('#d_allergy').val();
    var surg_history = $('#surg_his').val();
    var smoke = $('#smoke').is(':checked')?'YES':'NO';
    var alcohol = $('#alcohol').is(':checked')?'YES':'NO';
    var veg = $('#veg').is(':checked')?'YES':'NO';
    var nonveg = $('#nonveg').is(':checked')?'YES':'NO';
    var fam_his = $('#fam_his').val();
    var inv_done = $('#inv_done').val();
    var teh = $('#teh').val();
    var lap = $('#lap').val();
    var hyst = $('#hyst').val();
    var pbi = $('#pbi').val();
    var semen = $('#semen').val();
    var menstrual_con = $('#menstrual_con').val();
    var flow_nat = $('#flow_nat').val();
    var dysm = $('#dysm').val();
    var coital_bleeding = $('#coital_bleeding').val();
    var lmp = $('#lmp').val();
    var aware_fert = $('#aware_fert').val();
    var dyspa = $('#dyspa').val();
    var height = $('#height').val();
    var weight = $('#weight').val();
    var bmi = $('#bmi').val();
    var thyroid = $('#thyroid').val();
    var breast_galact = $('#breast_galact').val();
    var ovul_ind = $('#ovul_ind').val();
    var iui = $('#iui').val();
    var ivf = $('#ivf').val();
    var summary = $('#summary').val();
    var usg_date = $('#usg_date').val();
    var uterus = $('#uterus').val();
    var cavity = $('#cavity').val();
    var lt_ovary = $('#lt_ovary').val();
    var rt_ovary = $('#rt_ovary').val();
    var afc_lt = $('#afc_lt').val();
    var afc_rt = $('#afc_rt').val();
    var findings = $('#findings').val();
    var counsel = $('#counsel').val();
    var by = $('#by').val();
    var note = $('#note').val();
    var saved_by = $('#saved_by').val();
    var prn = $('#prn').val();
    var id = $('#id').val();
    var vsn = $('#vsn').val();
    var donor = $('#donor').val();
    var referral = $('#referral').val();

    var conf= confirm("Are you sure you want to create file?" );
   if (conf==true){
       $.post('controller_create_ivf_file.php',{

           wife_name : wife_name,
           husband_name : husband_name,
           husband_age : husband_age,
           wife_age : wife_age,
           husband_occ : husband_occ,
           wife_occ : wife_occ,
           address : address,
           husband_ph : husband_ph,
           wife_ph : wife_ph,
           ref_hosp : ref_hosp,
           marital_stat : marital_stat,
           infertility_type : infertility_type,
           htn : htn,
           tb : tb,
           dm : dm,
           asth : asth,
           hd : hd,
           allergy : allergy,
           surg_history : surg_history,
           smoke : smoke,
           alcohol : alcohol,
           veg : veg,
           nonveg : nonveg,
           fam_his : fam_his,
           inv_done : inv_done,
           teh : teh,
           lap : lap,
           hyst : hyst,
           pbi : pbi,
           semen : semen,
           menstrual_con : menstrual_con,
           flow_nat : flow_nat,
           dysm : dysm,
           coital_bleeding : coital_bleeding,
           lmp : lmp,
           aware_fert : aware_fert,
           dyspa : dyspa,
           height : height,
           weight : weight,
           bmi : bmi,
           thyroid : thyroid,
           breast_galact : breast_galact,
           ovul_ind : ovul_ind,
           iui : iui,
           ivf : ivf,
           summary : summary,
           usg_date : usg_date,
           uterus : uterus,
           cavity : cavity,
           lt_ovary : lt_ovary,
           rt_ovary : rt_ovary,
           afc_lt : afc_lt,
           afc_rt : afc_rt,
           findings : findings,
           counsel : counsel,
           by : by,
           note : note,
           saved_by : saved_by,
           prn : prn,
           id : id,
           vsn : vsn,
           donor : donor,
           referral : referral

       },
       function(data){
           
        if(data == 1){
            alert("Patient File Created Successfully!");           
            window.location.replace('index');         
        }
        else{
                alert("Patient Already Has An Open File");           
        }
       });
}
    //alert($('#htn').attr('checked'));

});




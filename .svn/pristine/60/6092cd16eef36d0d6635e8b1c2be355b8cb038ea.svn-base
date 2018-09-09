<?php
/* 
* Функция получения различных форма для модального онка
* Function get forms for modal dialog
* @param string $Id 
* @return xajaxResponse 
*/ 
function Get_Modal_Dialog_Form($Id)
{
    $objResponse = new xajaxResponse();
    $form="";
    if(strlen(trim($Id))>0){
         $form="
            <div id='dialog_form' class='form_block'>
                <form id='FormDialogModal' action='javascript:void(null);' onSubmit='xajax_Send_Modal_Dialog_Request(xajax.getFormValues(\"FormDialogModal\"));' >               
                ";
        switch($Id)  
        {          
            case 'call_back':      
                $form.="
                    <input type='hidden' name='request_type' id='request_type' value='call_back'>
                    <div class='row field-row dialog_header'>
                        <h1>Закажите обратный звонок</h1>
                        <p>мы перезвоним Вам в удобное для Вас время</p>
                    </div>
                    <div class='row field-row'>
                        <div class='col-xs-12 col-sm-12'>
                            <label>Представьтесь, пожалуйста:</label>
                            <input type='text' name='call_back_fio' id='call_back_fio' class='le-input'>
                        </div>
                        <div class='form_error' id='form_error_call_back_fio'></div>
                    </div>
                    <div class='row field-row'>
                        <div class='col-xs-12 col-sm-6'>
                            <label>Контактный телефон: *</label>
                            <input type='text' name='call_back_phone' id='call_back_phone' class='le-input'>
                            <div class='form_error' id='form_error_call_back_phone'></div>
                        </div>
                        <div class='col-xs-12 col-sm-6'>
                            <label>Удобное время для звонка</label>
                            <input type='text' name='call_back_time' id='call_back_time' class='le-input'>
                        </div>
                    </div>  
                    <div class='form_error' id='all_errors'></div>
                    <div class='dialog_btn'>
                        <input type='submit' name='send_form' id='send_form' class='le-button big' value='Заказать обратный звонок' >
                    </div>                        
                    ";              
            break;             
            default:  
                $form="";  
            break;      
        }   
        $form.="
                </form> 
            </div> ";
        $objResponse->assign("modal_content_replace","innerHTML", $form);
        $objResponse->call("modal_dialog_show(700)");
        $objResponse->call("ga_client_id_for_modal");
    }    
    return $objResponse;
}
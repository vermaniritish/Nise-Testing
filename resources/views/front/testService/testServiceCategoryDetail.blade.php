<?php use App\Models\Admin\CustomPageData; use App\Models\Admin\Settings; ?>
@extends('layouts.frontendlayout')
@section('content')
<section id="page-banner">
	<div class="single-page-title-area-bottom">
		<div class="auto-container">
			<div class="row">
				<div class="col-12 text-center">
					<div id="ost-container">
						<div class="ost-multi-header">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item"><a href="testing-services.php">Testing Services</a></li>
								<li class="breadcrumb-item active">Testing of Solar Photovoltaic modules</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END PAGE BANNER AND BREADCRUMBS -->

<!-- START SERVICE SECTION -->
<section id="service" class="section-padding">
    <div class="auto-container">	 
		<div class="row">
			<div class="col-lg-1 col-md-1 col-12">&nbsp;</div>
			<div class="col-lg-10 col-md-10 col-12">
				
				<div class="row">
					<div class="col-12 ser-page-into">
						<form id="formValidate" method="post" action="{{route('testServiceCategoryDetails',['slug'=> $testServiceCategoryDetail->slug])}}" class="test-module-form" enctype="multipart/form-data">
							@csrf
                        <div class="table-responsive">
                            <table class="table table-striped theme-table">
                                <thead> 
                                    <tr> 
                                        <th class="heading text-center" colspan="6">PV crystalline silicon/thin film Module Individual Tests</th>
                                    </tr>
                                    <tr>
                                        <th>Test</th>
                                        <th>Fee/Sample (INR)</th>
                                        <th>Number of samples</th>
                                        <th>SPV Module required per sample </th>
                                        <th>Total (INR)</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="test-row">
                                        <td width="35%">
                                            <select name="order_test[test_type_id][]" required class="selectpickerr show-tick field_test" data-live-search="true" title="Select test" style="width:80% !important">
                                                <option id="" value="">Select</option>
                                                @if(isset($serviceCategoryWiseTests) && $serviceCategoryWiseTests)
	                                                @foreach($serviceCategoryWiseTests as $servCatWiseTest)
	                                                	<option data-id="{{$servCatWiseTest->id}}" id="{{$servCatWiseTest->fee}}" value="{{$servCatWiseTest->id}}">{{$servCatWiseTest->title}}</option>
	                                                @endforeach
                                                @endif  
                                            </select>
                                        </td> 
                                        <td width="20%">
                                            <input name="order_test[sample_fee][]" readonly required value="0" type="text" class="form-control field_sample txtboxToFilterNumber">
                                        </td>
                                        <td width="10%">
                                            <input type="number" required step="1" name="order_test[number_of_sample][]" min="1" class="form-control number_of_sample txtboxToFilterNumber" value="1">
                                        </td>
                                         <td width="10%">
                                            <input type="number" readonly required step="1" name="order_test[spv_per_sample][]" min="1" class="form-control SPVmodule" value="0">
                                        </td>
                                        <td width="20%">
                                            <input type="text" readonly required name="order_test[total_test_amount][]" class="form-control total_test txtboxToFilterNumber">
                                        </td>
                                        <td width="5%" class="text-center action-col">
                                            <a href="javascript:void(0)" onclick="removeFunction(this);" class="btn btn-remove-row disabled" title="Remove row"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td> 
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="6">
                                            <a href="javascript:void(0)" class="btn-add-row">Add Row</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="label-col text-right">
                                            Total Number of Samples
                                        </td>
                                        <td><input required name="total_number_of_sample" type="text" readonly="" id="total_sample" class="form-control txtboxToFilterNumber" value="1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"  class="label-col text-right">
                                            Total Fee
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td><input  required name="total_fee" type="text" readonly="" id="total_fee" class="form-control txtboxToFilterNumber"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="label-col text-right"><input onclick="get_GST_Off();" type="checkbox" name="gst_optional" class="" value="1" id="GST_optional" style="vertical-align: text-bottom; margin-right: 5px;">GST Free Zone Option (optional)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="label-col text-right">
                                           GST @ {{ Settings::get('company_gst_value') ? Settings::get('company_gst_value') . '%' : '0%' }}
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td><input required name="total_service_tax_fee" type="text" readonly="" id="total_service_tax" class="form-control txtboxToFilterNumber"></td>
                                        <td></td>
                                    </tr>
                                    <!-- TDS OPTION STARTS -->
                                    <tr>
                                        <td colspan="2" class="label-col text-right">
                                           Less TDS (I.Tax)
                                           <select name="tds_itr_value" id="less_tds_itr" onchange="calculateFee();">
                                           		<option value="0">Select</option>
                                                <option value="2">2%</option>
                                                <option value="7.5">7.5%</option>
                                                <option value="10">10%</option>
                                           </select> 
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td><input required name="total_tds_itr" type="text" readonly="" id="total_tds_itr" class="form-control txtboxToFilterNumber"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="label-col text-right">
                                           Less TDS (GST)
                                           <select name="tds_gst_value" id="less_tds_gst" onchange="showSCGST(this);calculateFee()">
                                           		<option value="0">Select</option>
                                                <option value="2">IGST - 2%</option>
                                                <option value="SC-GST">SGST/CGST</option>
                                           </select> 
                                           <select name="tds_scgst_value" id="less_tds_scgst" class="hide" onchange="calculateFee()">
                                           		<option value="1">SGST - 1%</option>
                                                <option value="2">CGST - 1%</option>
                                           </select> 
                                           <span class="text-danger" style="display:block"><small>* Applicable only on PSUs, Central Govt., State Govt. undertakings</small></span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td><input required name="total_tds_igst" type="text" readonly="" id="total_tds_igst" class="form-control txtboxToFilterNumber"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="label-col text-right">
                                            Grand Total Fee
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td><input required type="text" name="grand_total_fee"  readonly="" id="grand_total" class="form-control txtboxToFilterNumber"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped theme-table">
                                <thead> 
                                    <tr> 
                                        <th class="heading text-center" colspan="6">PV Module Details </th>
                                    </tr>      
                                </thead>
                                <tbody>
                                    <tr class="test-row">
                                        <td style="width: 48%;">Please upload PV Module Details: <span class="text-danger">*</span><br/>Download <a href="{{ isset($testServiceCategoryDetail->sample_file) && $testServiceCategoryDetail->sample_file ? asset($testServiceCategoryDetail->sample_file) : '#' }}" target="_blank"}}"><strong>Sample file</strong></a> to file the details</td>
                                        <td><input required type="file" name="upload_pv_module_docs" class="form-control" required="required"></td>
                                     <td style="width: 6%;"></td>                                  
                                    </tr> 
                                    <tr>
                                        <td colspan="6">
                                            <ul class="text-danger" style="list-style:none">
                                            	<li><strong>Note : Each Module shall carry the following clear indelible marking (all details inside the glass)</strong></li>
                                                <li>a) Name, Logo or Symbol of Manufature</li>
                                                <li>b) Type or Model number</li>
                                                <li>c) Serial number</li>
                                                <li>d) Polarity or Terminals or Leads</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-striped theme-table">
                            <thead> 
                                <tr> 
                                    <th class="heading text-center" colspan="11">
                                   Details of Document to be submited by customer
                                    </th>
                                </tr>                                      
                            </thead>                                 
                        </table>


                            @php
                                $documents = json_decode($testServiceCategoryDetail->detail_of_document ?? '[]', true);
                            @endphp

                            @if(isset($documents) && !empty($documents))
                                @foreach($documents as $index => $doc)
                                
                                <div class="repeatdivadd">

                                    <!-- TABLE 1: SSI / NSIC / MSME -->
                                    <table class="table table-striped table-bordered">
                                        @if($index == 0)
                                        <thead> 
                                            <tr>
                                                <th>Name of Document</th>
                                                <th></th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            <tr class="test-row">
                                                <td style="width: 48%;">{{isset($doc['title']) && $doc['title'] ? $doc['title'] : ''}} <span class="text-danger">*</span></td>
                                                <td>
                                                    <input type="hidden" name="order_detail[title][{{ $index }}]" value="{{isset($doc['title']) && $doc['title'] ? $doc['title'] : ''}}" class="form-control">
                                                    <input required type="file" name="order_detail[name_of_doc_ssi][{{ $index }}]" class="form-control">
                                                </td>
                                                <td style="width: 6%;" class="text-center">
                                                    <!-- first row remove disabled -->
                                                    <a href="javascript:void(0)" onclick="remove(this);" class="btn btn-remove-row {{ $index == 0 ? 'disabled hide' : '' }}" title="Remove row">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr class="test-row">
                                                <td style="width: 48%;">{{isset($doc['sub_title']) && $doc['sub_title'] ? $doc['sub_title'] : ''}} <span class="text-danger">*</span></td>
                                                <td>
                                                    <input type="hidden" value="{{isset($doc['sub_title']) && $doc['sub_title'] ? $doc['sub_title'] : ''}}" name="order_detail[sub_title][{{ $index }}]" class="form-control">
                                                    <input class="billmat form-control" type="file" name="order_detail[name_of_doc_billmat][{{ $index }}]" required>
                                                </td>
                                                <td style="width: 5%;" class="text-center action-col">
                                                    <a href="javascript:void(0)" onclick="remove(this);" class="btn btn-remove-row {{ $index == 0 ? 'disabled hide' : '' }}" title="Remove row">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- <div id="parentrepeatdivadd">
                            <div class="repeatdivadd">
                                <table class="table table-striped table-bordered">
                                    <thead> 
                                        <tr>
                                            <th>Name of Document</th>
                                            <th></th>
                                             <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="test-row">
                                            
                                            <td style="width: 48%;">Self attested copy of SSI Registration/NSIC/MSME <span class="text-danger">*</span></td>
                                            <td><input required type="file" name="order_detail[name_of_doc_ssi][]" class="form-control" required="required"></td>
                                         <td style="width: 6%;"></td>                                  
                                        </tr> 
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered">
                                    
                                    <tbody>
                                        <tr class="test-row">
                                            <td style="width: 48%;">Bill of Material of PV Module <span class="text-danger">*</span></td>
                                            <td><input class="billmat form-control" type="file" name="order_detail[name_of_doc_billmat][]" required="required"></td>
                                            <td style="width: 5%;" class="text-center action-col">
                                                <a href="javascript:void(0)" onclick="remove(this);" class="btn btn-remove-row disabled hide" title="Remove row"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>  
                                        </tr>                                      
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        <!-- <table class="table table-striped hide">                               
                            <tbody>                                                              
                                <tr>
                                    <td colspan="10">
                                        <a onclick="add();" href="javascript:void(0)" class="btn-add-row-new">Add Row</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>  -->
                       </div>
                       <div class="table-responsive">
                        <table class="table table-striped theme-table">
                            <thead> 
                                <tr> 
                                    <th class="heading text-center" colspan="11">
                                   Internal Test Report (optional)
                                    </th>
                                </tr>                                      
                            </thead>                                 
                        </table>
                        <div id="parentrepeatdivadd141118">
                             <div class="repeatdivadd">
                            <table class="table table-striped table-bordered">         
                                <tbody>
                                    <tr class="test-row">
                                        
                                        <td style="width: 48%;">Internal Test Report (optional)</td>
                                        <td><input type="file" name="internal_test_report" class="form-control"></td>
                                     <td style="width: 6%;"></td>                                  
                                    </tr> 
                                </tbody>
                            </table>
                        </div><!-- repeat div end -->

                         </div><!-- parent repeat div end -->
                         <table class="table table-striped ">                                    
                                <tbody>     
                                    @php
                                        $otherReqForms = json_decode($testServiceCategoryDetail->other_required_form ?? '[]', true);
                                    @endphp

                                    @if(isset($otherReqForms) && !empty($otherReqForms))
                                        @foreach($otherReqForms as $index => $otherReqForm)         
                                        <tr>
                                            <td colspan="10">
                                                <a href="{{ isset($otherReqForm['file']) && $otherReqForm['file'] ? asset($otherReqForm['file']) : '#' }}" target="_blank" class="text-danger"><p>{{isset($otherReqForm['name']) && $otherReqForm['name'] ? $otherReqForm['name'] : ''}}</p></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table> 
                       </div>
                        <div class="row form-footer-row">
                            <div class="col-md-6 col-sm-6">
                                <div class="checkbox">
                                    <label style="padding-left: 0;">
                                        <input required type="checkbox" name="terms-and-condition" value="" id="terms-checkbox">
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        I agree to general <a target="_blank" href="https://nise.res.in/terms-of-use/"><strong>Terms and Conditions</strong></a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-success btn-payment pull-right">Make Payment</button>
                                <input type="hidden" name="myCsrf" value="48db0023a5378f9a4cd6bdb2e17c91c6" />
                            </div>
                        </div>                         
                    </form>
					</div>
				</div>	
			</div>
			<div class="col-lg-1 col-md-1 col-12">&nbsp;</div>
		</div>
    </div>
</section>

<script>

    //$(document).ready(function(){
		
        $(".btn-add-row").click(function(){
            var elem_val = $(this).parent().parent().parent();
            var html_val = elem_val.find('tr.test-row:eq(0)').html();
            //alert(html_val);
            elem_val.find("tr.test-row:last").after('<tr class="test-row">'+html_val+'</tr>');
            elem_val.find("tr.test-row:last").find("td a.btn-remove-row").removeClass("disabled");
            //$(".selectpicker").selectpicker('refresh');
            $('.field_sample, .number_of_sample, .total_test').off().on('keyup',calculateFee);
            $('.number_of_sample').off().on('change',calculateFee);
            $('.selectpickerr').change(function(){

                    var spv = $(this).find(':selected').attr("data-id");
       				$(this).parent('td').next('td').next('td').next('td').children('.SPVmodule').val(spv); 



                var price = parseInt(allPrice[$(this).val()]);
                var rr = parseInt(allPrice[$(this).val()]);
                $(this).parent('td').next('td').children('.field_sample').val(price);
                calculateFee();
            });
            calculateFee();
            numberValidation();
        });
        
  //  });
    
    function removeFunction(thisval) {
        $(thisval).parent().parent().remove();
        calculateFee();
    }

    $(function() {
        enable_cb();
        $("#terms-checkbox").click(enable_cb);
    });

    function enable_cb() {
        if (this.checked) {
          $(".btn-payment").removeAttr("disabled");
        } else {
          $(".btn-payment").attr("disabled", true);
        }
    }
	function calculateModule(){
		var total_sample = 0;var n = 0;
		 $('.field_module').each(function(){
			total_sample++;
			$(".number_of_model:eq("+n+")").html(total_sample)
			++n;
		});	
	}
    function calculateFee(){
		calculateModule();
        var n = 0;
        var total_sample = 0;
        
        $('.field_sample').each(function(){

            //fee amount
            var feeAmount = parseInt($(this).val()) || 0;
            var samplecount = parseInt($(".number_of_sample:eq("+n+")").val());
            total_sample+=samplecount;
            //placing total
            var totalAmount = eval(feeAmount*samplecount);
            $(".total_test:eq("+n+")").val(totalAmount);
            ++n;
        });

        // in all salt mist test and IEC61853 make SPV Module required per sample "3" and increase as per incresement on number of samples -- 13.11.18

        $('.selectpickerr ').each(function(){
             var selectpickerr_id  = $(this).find(':selected').val();
            var samplecount = parseInt($(this).parent('td').next('td').next('td').children('.number_of_sample').val()); 
            if(selectpickerr_id=='21' || selectpickerr_id=='22' || selectpickerr_id=='23' || selectpickerr_id=='24' || selectpickerr_id=='25' || selectpickerr_id=='26'){
            
            var SPV_Module_required_per_sample  = $(this).find(':selected').attr("data-id");
            var SPV_Module_required_per_sample1 = eval(SPV_Module_required_per_sample*samplecount);
            //$(".SPVmodule:eq("+nn+")").val(SPV_Module_required_per_sample1);
            $(this).parent('td').next('td').next('td').next('td').children('.SPVmodule').val(SPV_Module_required_per_sample1); 



            }
        });

             // end 13.11.18


        $("#total_sample").val(total_sample || 0);


        //total fare
        var totalFee = 0;
        $(".total_test").each(function(){
            totalFee += parseInt($(this).val()) || 0;
        });
        $("#total_fee").val(totalFee);

        var gstValue = {{ Settings::get('company_gst_value', 18) }};
        //service tax
        var serviceTax = 0;               

        if($('#GST_optional').prop("checked") == true){
            var serviceTax = 0;
        }else{
            var serviceTax = ((totalFee * gstValue) / 100) || 0;
        }
		$("#total_service_tax").val(serviceTax);
		
		<!----------------------------- Start TDS Codes ------------------------------->
		//TDS ITR -- Added by Ankush
		var ttds = $("#less_tds_itr").val();;
		
        var tds = ((totalFee * ttds) / 100) || 0;
		
        $("#total_tds_itr").val(tds);
		
		//TDS CGST -- Added by Ankush
		var cgtds = $('#less_tds_gst').val();
		if(cgtds == 'SC-GST'){
			$('#total_tds').val('0');
			//var scgtds = $('#less_tds_scgst').val();
			var ctds = ((totalFee * 1) / 100) || 0;	
		}else{
			var ctds = ((totalFee * cgtds) / 100) || 0;	
		}
		$('#total_tds_igst').val(ctds);
		
		<!-------------------------------- End TDS Codes ------------------------------->
		
        var grandTotal = serviceTax + totalFee - tds - ctds;

        $("#grand_total").val(parseFloat(grandTotal).toFixed(2));
       

    }

    $('.field_sample, .number_of_sample, .total_test').on('keyup',calculateFee);
    $('.number_of_sample').on('change',calculateFee);

    function numberValidation(){

        $(".txtboxToFilterNumber").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl/cmd+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: Ctrl/cmd+C
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: Ctrl/cmd+X
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    }
    numberValidation();
                var allPrice = {"1":"4550","2":"4550","3":"4550","4":"21840","5":"21840","6":"8190","7":"16380","8":"33670","9":"22750","10":"22750","11":"254800","12":"273000","13":"136500","14":"4550","15":"13650","16":"4550","17":"4550","18":"195000","20":"5200","21":"109200","22":"54600","23":"72800","24":"109200","25":"182000","26":"65000","27":"13000"};            

    $('.selectpickerr').change(function(){


       //alert($(this).find(':selected').attr("data-id"));

       var spv = $(this).find(':selected').attr("data-id");
       $(this).parent('td').next('td').next('td').next('td').children('.SPVmodule').val(spv); 



        var price = parseInt(allPrice[$(this).val()]);
        $(this).parent('td').next('td').children('.field_sample').val(price); 
        // if(this.value == 18){
        //     $(".number_of_sample").val('4');
        //     $(".billmat").prop('required',true);
        // }else{
        //     $(".number_of_sample").val('1');
        //     $(".billmat").prop('required',false);
        // }
        calculateFee();
    });


    var repeatdiv = $("#parentrepeatdivadd").html();

    function add(){        
        $("#parentrepeatdivadd").append(repeatdiv);
        $('#parentrepeatdivadd').find("tr.test-row:last").find("td a.btn-remove-row").removeClass("disabled");
    }

    function remove(thisval) {               
       $(thisval).parent().parent().parent().parent().parent().remove();
    }

    function get_GST_Off() {
            calculateFee();
    }

</script>


@endsection
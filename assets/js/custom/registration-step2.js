
// Show Add more button after Selection //

$("#purposeSelect").change( function(e){
  $("#add_more").show();
  });



// Clear All Selection in Modal box //

$(".clear-select").click(function (e){
    e.preventDefault();
  $('#industry_check input:checked').each(function() {
    $(this).prop('checked', false);
}); 

$('#skills_check input:checked').each(function() {
    $(this).prop('checked', false);
}); 

$('#funding_check input:checked').each(function() {
    $(this).prop('checked', false);
}); 

$('#alliance_check input:checked').each(function() {
    $(this).prop('checked', false);
}); 

$('#investment_check input:checked').each(function() {
    $(this).prop('checked', false);
}); 
});






// Save Industry Function //

$("#save-industry").click(function (e) { 
    e.preventDefault();
$('#industry_check input:checked').each(function() {
    $(this).prop('checked', false);
});
var index=localStorage.getItem("indexIndustry");

if(index==0)
{
var inputIndustry='<input type="text" class="form-control required_for_purpose" id="InputIndustry" name="skills[]" placeholder="Please select your Industry" disabled>';
if (Array.isArray(allpurpose[index].industry) &&  allpurpose[index].industry.length) {
        var industryDiv=[];
for(let i=0; i<allpurpose[index].industry.length; i++)
{
     industryDiv[i]=allpurpose[index].industry[i].name;
}
    
  document.getElementById("InputIndustryy").innerHTML=(industryDiv.join(" "));
}
else{
document.getElementById("InputIndustryy").innerHTML=inputIndustry;
$("#InputIndustryy").css('background', '#fffff');
$("#InputIndustryy").css('padding', '0px');
}
$("#InputIndustryy").css('background', '#f7f7f7');
$("#InputIndustryy").css('padding', '5px'); 
}
else{
var inputIndustry='<input type="text" class="form-control required_for_purpose" id="InputIndustry'+index+'" name="skills[]" placeholder="Please select your Industry" disabled>';
if (Array.isArray(allpurpose[index].industry) &&  allpurpose[index].industry.length) {
var industryDiv=[];
for(let i=0; i<allpurpose[index].industry.length; i++)
{
     industryDiv[i]=allpurpose[index].industry[i].name;
}
  document.getElementById("InputIndustryy"+index).innerHTML=(industryDiv.join(" "));
}
else{
document.getElementById("InputIndustryy"+index).innerHTML=inputIndustry;
$("#InputIndustryy"+index).css('background', '#fffff');
$("#InputIndustryy"+index).css('padding', '0px');
}

$("#InputIndustryy"+index).css('background', '#f7f7f7');
$("#InputIndustryy"+index).css('padding', '5px');
}
$('#industry-section').modal('hide'); 
});

function industryPush(data){
var indexIndustry=$("#"+data).attr('data-index');
localStorage.setItem("indexIndustry", indexIndustry);
var index=localStorage.getItem("indexIndustry");
$('#industry_check input').each(function() {
    if(allpurpose[index].industryId.length!=0){
    for(let i=0; i<=allpurpose[index].industryId.length;i++)
    {
    if(allpurpose[index].industryId[i]==$(this).val()){
    $(this).prop('checked', true);
    }
    }
    }
});
}

$("input[name='industry_ids']").change(function() {
  var index=localStorage.getItem("indexIndustry");
  var checked =$(this).val();
  var div="<div class='demoSkills'>"+($(this).attr('data-name'))+"<a class='x-box' onclick='removeIndsutry(`"+$(this).attr('data-name')+"`,`"+$(this).val()+"`)'>x</a></div>";
  var name ={id:checked,name:div};
    if ($(this).is(':checked')) {
      allpurpose[index].industryId.push(checked);
      allpurpose[index].industry.push(name);
    }else{
    allpurpose[index].industryId.splice($.inArray(checked,  allpurpose[index].industryId),1);
    allpurpose[index].industry.splice($.inArray(name, allpurpose[index].industry),1);
    }
  });

function removeIndustry(data)
{
    alert(data);
}
// Save Industry Ends Here //

// Save Skills FUnction //


$("#save-skills").click(function (e) { 
    e.preventDefault();
$('#skills_check input:checked').each(function() {
    $(this).prop('checked', false);
});
var index=localStorage.getItem("indexSkills");
if(index=='0')
{
var inputSkills='<input type="text" class="form-control required_for_purpose pointer" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled="">';
if (Array.isArray(allpurpose[index].skillData) &&  allpurpose[index].skillData.length) {
var skillsDiv=[];
for(let i=0; i<allpurpose[index].skillData.length; i++)
{
     skillsDiv[i]=allpurpose[index].skillData[i].name;
}
  document.getElementById("InputSkillss").innerHTML=(skillsDiv.join(" "));
}
else{
document.getElementById("InputSkillss").innerHTML=inputSkills;
$("#InputSkillss").css('background', '#fffff');
$("#InputSkillss").css('padding', '0px');
}
$("#InputSkillss").css('background', '#f7f7f7');
$("#InputSkillss").css('padding', '5px'); 
}
else{
var inputSkills='<input type="text" class="form-control required_for_purpose pointer" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled="">';
if (Array.isArray(allpurpose[index].skillData) &&  allpurpose[index].skillData.length) {
    var skillsDiv=[];
for(let i=0; i<allpurpose[index].skillData.length; i++)
{
     skillsDiv[i]=allpurpose[index].skillData[i].name;
}
  document.getElementById("InputSkillss"+index).innerHTML=(skillsDiv.join(" "));
}
else{
$("#InputSkillss"+index).css('background', '#fffff');
$("#InputSkillss"+index).css('padding', '0px');
document.getElementById("InputSkillss"+index).innerHTML=inputSkills;
}
$("#InputSkillss"+index).css('background', '#f7f7f7');
$("#InputSkillss"+index).css('padding', '5px');
}
$('#skill-section').modal('hide'); 
});
function skillsPush(data){
var indexSkills=$("#"+data).attr('data-index');
localStorage.setItem("indexSkills", indexSkills);
var index=localStorage.getItem("indexSkills");
$('#skills_check input').each(function() {
    if(allpurpose[index].skillId.length!=0){
    for(let i=0; i<=allpurpose[index].skillId.length;i++)
    {
    if(allpurpose[index].skillId[i]==$(this).val()){
    $(this).prop('checked', true);
    }
    }
    }
});
}

$("input[name='skill_ids']").change(function() {
  var index=localStorage.getItem("indexSkills");
  var checked =$(this).val();
  var div="<div class='demoSkills'>"+($(this).attr('data-name'))+"<a class='x-box' onclick='removeSkills(`"+$(this).attr('data-name')+"`,`"+$(this).val()+"`)'>x</a></div>";
  var name ={id:checked,name:div};
    if ($(this).is(':checked')) {
      allpurpose[index].skillId.push(checked);
      allpurpose[index].skillData.push(name);
    }else{
    allpurpose[index].skillId.splice($.inArray(checked,  allpurpose[index].skillId),1);
    allpurpose[index].skillData.splice($.inArray(name, allpurpose[index].skillData),1);
    }
    console.log(allpurpose);
  });


// Save Skills Ends Here //


// Save Alliances Function //


$("#save-alliances").click(function (e) { 
    e.preventDefault();
$('#alliance_check input:checked').each(function() {
    $(this).prop('checked', false);
});
var index=localStorage.getItem("indexAlliance");
if(index==0)
{
var inputAlliance='<input type="text" class="pointer required_for_purpose form-control" id="InputAlliances" name="alliances[]" placeholder="Please select alliances" disabled="">';
if (Array.isArray(allpurpose[index].alliance) &&  allpurpose[index].alliance.length) {
var allianceDiv=[];
for(let i=0; i<allpurpose[index].alliance.length; i++)
{
     allianceDiv[i]=allpurpose[index].alliance[i].name;
}
  document.getElementById("InputAlliancess").innerHTML=(allianceDiv.join(" "));
}
else{
document.getElementById("InputAlliancess").innerHTML=inputAlliance;
$("#InputAlliancess").css('background', '#fffff');
$("#InputAlliancess").css('padding', '0px');
}
$("#InputAlliancess").css('background', '#f7f7f7');
$("#InputAlliancess").css('padding', '5px'); 
}
else{
var inputAlliance='<input type="text" class="pointer required_for_purpose form-control" id="InputAlliances" name="alliances[]" placeholder="Please select alliances" disabled="">';
if (Array.isArray(allpurpose[index].alliance) &&  allpurpose[index].alliance.length) {
var allianceDiv=[];
    for(let i=0; i<allpurpose[index].alliance.length; i++)
{
     allianceDiv[i]=allpurpose[index].alliance[i].name;
}
  document.getElementById("InputAlliancess"+index).innerHTML=(allianceDiv.join(" "));
}
else{
document.getElementById("InputAlliancess"+index).innerHTML=inputAlliance;
$("#InputAlliancess"+index).css('background', '#fffff');
$("#InputAlliancess"+index).css('padding', '0px');
}
$("#InputAlliancess"+index).css('background', '#f7f7f7');
$("#InputAlliancess"+index).css('padding', '5px');
}
$('#alliances-section').modal('hide'); 
});
function alliancePush(data){
var indexAlliance=$("#"+data).attr('data-index');
localStorage.setItem("indexAlliance", indexAlliance);
var index=localStorage.getItem("indexAlliance");
$('#alliance_check input').each(function() {
    if(allpurpose[index].allianceId.length!=0){
    for(let i=0; i<=allpurpose[index].allianceId.length;i++)
    {
    if(allpurpose[index].allianceId[i]==$(this).val()){
    $(this).prop('checked', true);
    }
    }
    }
});
}

$("input[name='alliances_ids']").change(function() {
  var index=localStorage.getItem("indexAlliance");
  var checked =$(this).val();
  var div="<div class='demoSkills'>"+($(this).attr('data-name'))+"<a class='x-box' onclick='removeAlliance(`"+$(this).attr('data-name')+"`,`"+$(this).val()+"`)'>x</a></div>";
  var name ={id:checked,name:div};
    if ($(this).is(':checked')) {
      allpurpose[index].allianceId.push(checked);
      allpurpose[index].alliance.push(name);
    }else{
    allpurpose[index].allianceId.splice($.inArray(checked,  allpurpose[index].allianceId),1);
    allpurpose[index].alliance.splice($.inArray(name, allpurpose[index].alliance),1);
    }
    console.log(allpurpose);
  });


// Save alliances Ends Here //


// Save Funding Function //


$("#save-funding").click(function (e) { 
    e.preventDefault();
$('#funding_check input:checked').each(function() {
    $(this).prop('checked', false);
});
var index=localStorage.getItem("indexFunding");
if(index==0)
{
var inputFunding='<input type="text" data-index="0" class=" required_for_purpose pointer form-control" id="InputFunding" name="funding[]" placeholder="Please select funding" disabled="">';
if (Array.isArray(allpurpose[index].funding) &&  allpurpose[index].funding.length) {
var fundingDiv=[];
for(let i=0; i<allpurpose[index].funding.length; i++)
{
     fundingDiv[i]=allpurpose[index].funding[i].name;
}
  document.getElementById("Inputfundingss").innerHTML=(fundingDiv.join(" "));
}
else{
document.getElementById("Inputfundingss").innerHTML=inputFunding;
$("#Inputfundingss").css('background', '#fffff');
$("#Inputfundingss").css('padding', '0px');
}
$("#Inputfundingss").css('background', '#f7f7f7');
$("#Inputfundingss").css('padding', '5px'); 
}
else{
var inputFunding='<input type="text" data-index="0" class="required_for_purpose pointer form-control" id="InputFunding" name="funding[]" placeholder="Please select funding" disabled="">';
if (Array.isArray(allpurpose[index].funding) &&  allpurpose[index].funding.length) {

var fundingDiv=[];
for(let i=0; i<allpurpose[index].funding.length; i++)
{
     fundingDiv[i]=allpurpose[index].funding[i].name;
}
  document.getElementById("Inputfundingss"+index).innerHTML=(fundingDiv.join(" "));
}
else{
document.getElementById("Inputfundingss"+index).innerHTML=inputFunding;
$("#Inputfundingss"+index).css('background', '#fffff');
$("#Inputfundingss"+index).css('padding', '0px');
}
$("#Inputfundingss"+index).css('background', '#f7f7f7');
$("#Inputfundingss"+index).css('padding', '5px');
}
$('#funding-section').modal('hide'); 
});
function fundingPush(data){
var indexFunding=$("#"+data).attr('data-index');
localStorage.setItem("indexFunding", indexFunding);
var index=localStorage.getItem("indexFunding");
$('#funding_check input').each(function() {
    if(allpurpose[index].fundingId.length!=0){
    for(let i=0; i<=allpurpose[index].fundingId.length;i++)
    {
    if(allpurpose[index].fundingId[i]==$(this).val()){
    $(this).prop('checked', true);
    }
    }
    }
});
}

$("input[name='funding_ids']").change(function() {
  var index=localStorage.getItem("indexFunding");
  var checked =$(this).val();
  var div="<div class='demoSkills'>"+($(this).attr('data-name'))+"<a class='x-box' onclick='removeFunding(`"+$(this).attr('data-name')+"`,`"+$(this).val()+"`)'>x</a></div>";
  var name ={id:checked,name:div};
    if ($(this).is(':checked')) {
      allpurpose[index].fundingId.push(checked);
      allpurpose[index].funding.push(name);
    }else{
    allpurpose[index].fundingId.splice($.inArray(checked,  allpurpose[index].fundingId),1);
    allpurpose[index].funding.splice($.inArray(name, allpurpose[index].funding),1);
    }
    console.log(allpurpose);
  });


// Save funding Ends Here //

// Save Investment Function //


$("#save-investment").click(function (e) { 
    e.preventDefault();
$('#investment_check input:checked').each(function() {
    $(this).prop('checked', false);
});
var index=localStorage.getItem("indexInvestment");
if(index==0)
{
var inputInvestment='<input type="text" class="pointer required_for_purpose form-control" data-index="0" id="InputInvestment" name="investment[]" placeholder="Please select investment" disabled="">';
if (Array.isArray(allpurpose[index].investmentData) &&  allpurpose[index].investmentData.length) {
    var investmentDiv=[];
for(let i=0; i<allpurpose[index].investmentData.length; i++)
{
     investmentDiv[i]=allpurpose[index].investmentData[i].name;
}
  document.getElementById("Inputinvestmentss").innerHTML=(investmentDiv.join(" "));
}
else{
document.getElementById("Inputinvestmentss").innerHTML=inputInvestment;
$("#Inputinvestmentss").css('background', '#fffff');
$("#Inputinvestmentss").css('padding', '0px');
}
$("#Inputinvestmentss").css('background', '#f7f7f7');
$("#Inputinvestmentss").css('padding', '5px'); 
}
else{
var inputInvestment='<input type="text" class="pointer required_for_purpose form-control" data-index="0" id="InputInvestment" name="investment[]" placeholder="Please select investment" disabled="">';
if (Array.isArray(allpurpose[index].investmentData) &&  allpurpose[index].investmentData.length) {
var investmentDiv=[];
for(let i=0; i<allpurpose[index].investmentData.length; i++)
{
     investmentDiv[i]=allpurpose[index].investmentData[i].name;
}
  document.getElementById("Inputinvestmentss"+index).innerHTML=(investmentDiv.join(" "));
}
else{
document.getElementById("Inputinvestmentss"+index).innerHTML=inputInvestment;
$("#Inputinvestmentss"+index).css('background', '#fffff');
$("#Inputinvestmentss"+index).css('padding', '0px');
}
$("#Inputinvestmentss"+index).css('background', '#f7f7f7');
$("#Inputinvestmentss"+index).css('padding', '5px');
}
$('#investment-section').modal('hide'); 
});
function investmentPush(data){
var indexInvestment=$("#"+data).attr('data-index');
localStorage.setItem("indexInvestment", indexInvestment);
var index=localStorage.getItem("indexInvestment");
$('#investment_check input').each(function() {
    if(allpurpose[index].investmentId.length!=0){
    for(let i=0; i<=allpurpose[index].investmentId.length;i++)
    {
    if(allpurpose[index].investmentId[i]==$(this).val()){
    $(this).prop('checked', true);
    }
    }
    }
});
}

$("input[name='investment_ids']").change(function() {
  var index=localStorage.getItem("indexInvestment");
  var checked =$(this).val();
  var div="<div class='demoSkills'>"+($(this).attr('data-name'))+"<a class='x-box' onclick='removeInvestment(`"+$(this).attr('data-name')+"`,`"+$(this).val()+"`)'>x</a></div>";
  var name ={id:checked,name:div};
    if ($(this).is(':checked')) {
      allpurpose[index].investmentId.push(checked);
      allpurpose[index].investmentData.push(name);
    }else{
    allpurpose[index].investmentId.splice($.inArray(checked,  allpurpose[index].investmentId),1);
    allpurpose[index].investmentData.splice($.inArray(name, allpurpose[index].investmentData),1);
    }
    console.log(allpurpose);
  });


// Save Investment Ends Here //



function statusPush(data)
{
    var statusValue=$("#"+data).val();
    var index=$("#"+data).attr('data-index');
    allpurpose[index].status=statusValue;
    console.log("add",allpurpose);
}

function visionPush(data)
{
    var visionValue=$("#"+data).val();
    var index=$("#"+data).attr('data-index');
    allpurpose[index].vision=visionValue;
    console.log("add",allpurpose);
}


function businessPush(data)
{
    var buisnessValue=$("#"+data).val();
    var index=$("#"+data).attr('data-index');
    allpurpose[index].businessPlan=buisnessValue;
    console.log("add",allpurpose);
}

function strengthPush(data)
{
    var strengthValue=$("#"+data).val();
    var index=$("#"+data).attr('data-index');
    allpurpose[index].strength=strengthValue;
    console.log("add",allpurpose);
}

function supplementPush(data)
{
    var supplementValue=$("#"+data).val();
    var index=$("#"+data).attr('data-index');
    allpurpose[index].supplement=supplementValue;
    console.log("add",allpurpose);
}



var allpurpose=[
      {
        id: 0,
        purposeId: 0,
        purpose: '',
        industryId: [],
        industry: [],
        businessPlan: '',
        skillData: [],
        skillId: [],
        funding: [],
        fundingId: [],
        alliance: [],
        allianceId: [],
        status: '',
        vision: '',
        strength: '',
        supplement: '',
        investmentData: [],
        investmentId: [],
      },
    ];
var uniqueId = 1;
$(function() {
     $('#add_more').click(function() {
    
         
 var purposeObject ={
        id: uniqueId,
        purposeId: 0,
        purpose: '',
        industryId: [],
        industry: [],
        businessPlan: '',
        skillData: [],
        skillId: [],
        funding: [],
        fundingId: [],
        alliance: [],
        allianceId: [],
        status: '',
        vision: '',
        strength: '',
        supplement: '',
        investmentData: [],
        investmentId: [],
      }; 
      
      
   allpurpose.push(purposeObject); 
   
    var copy = $("#fields").clone(true);
    var formId = 'fields' + uniqueId;
    copy.attr('id', formId );
    $('.form-data').append(copy);
    $('#' + formId).find('input,select,div,span,a,textarea').each(function(){
    $(this).attr('id', $(this).attr('id') + uniqueId);
    $(this).attr('data-index', uniqueId);
    $("#"+formId).children().hide();
    $("#"+formId).children(".purpose").show(); 
    });
    var alpha=["First","Second","Third","Fourth","Fifth","Sixth","Seventh","Eighth","Nineth","Tenth"];
    document.getElementById("purpose_counter"+uniqueId).innerHTML=alpha[uniqueId];
    
    $("#vision"+uniqueId).val(allpurpose[uniqueId].vision);
    $("#InputBusinessContent"+uniqueId).val(allpurpose[uniqueId].businessPlan);
    $("#supplement"+uniqueId).val(allpurpose[uniqueId].businessPlan);
    $("#strength"+uniqueId).val(allpurpose[uniqueId].businessPlan);
   
    var inputIndustry='<input type="text" class="form-control" id="InputIndustry" name="skills[]" placeholder="Please select your Industry" disabled>';
    document.getElementById("InputIndustryy"+uniqueId).innerHTML=inputIndustry;
    $("#InputIndustryy"+uniqueId).css('background', '#fffff');
    $("#InputIndustryy"+uniqueId).css('padding', '0px');
    
    var inputSkills='<input type="text" class="form-control pointer" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled="">';
    document.getElementById("InputSkillss"+uniqueId).innerHTML=inputSkills;
    $("#InputSkillss"+uniqueId).css('background', '#fffff');
    $("#InputSkillss"+uniqueId).css('padding', '0px');
    
    var inputAlliance='<input type="text" class="pointer form-control" id="InputAlliances" name="alliances[]" placeholder="Please select alliances" disabled="">';
    document.getElementById("InputAlliancess"+uniqueId).innerHTML=inputAlliance;
    $("#InputAlliancess"+uniqueId).css('background', '#fffff');
    $("#InputAlliancess"+uniqueId).css('padding', '0px');
    
    var inputFunding='<input type="text" data-index="0" class="pointer form-control" id="InputFunding" name="funding[]" placeholder="Please select funding" disabled="">';
    document.getElementById("Inputfundingss"+uniqueId).innerHTML=inputFunding;
    $("#Inputfundingss"+uniqueId).css('background', '#fffff');
    $("#Inputfundingss"+uniqueId).css('padding', '0px');
    
    uniqueId++;  
     });
});

var i = 1;
function myFunction(data){

var value=$("#"+data).val();
var parentID=$("#"+data).parent().parent().attr('id');
var index=$("#"+data).attr('data-index');
allpurpose[index].purposeId=value;
allpurpose[index].strength='';
allpurpose[index].status='';
allpurpose[index].businessPlan='';
allpurpose[index].vision='';
allpurpose[index].funding=[];
allpurpose[index].fundingId=[];
allpurpose[index].industry=[];
allpurpose[index].industryId=[];
allpurpose[index].investmentData=[];
allpurpose[index].investmentId=[];
allpurpose[index].skillData=[];
allpurpose[index].skillId=[];
allpurpose[index].supplement='';
allpurpose[index].alliance=[];
allpurpose[index].allianceId=[];
if(index==0)
{
   $("#statusSelect").val('Please choose Status'); 
   document.getElementById("InputAlliancess").innerHTML='<input type="text" data-index="0" class="pointer form-control" id="InputAlliances" name="alliances[]" placeholder="Please select alliances" disabled="">';
   document.getElementById("InputIndustryy").innerHTML='<input data-index="0" type="text" class="required_for_purpose form-control pointer" id="InputIndustry" name="industry[]" placeholder="Please select your industry" disabled="">';
   document.getElementById("InputSkillss").innerHTML='<input data-index="0" type="text" class="form-control pointer required_for_purpose" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled="">';
   document.getElementById("Inputfundingss").innerHTML='<input type="text" data-index="0" class="required_for_purpose pointer form-control" id="InputFunding" name="funding[]" placeholder="Please select funding" disabled="">';
   document.getElementById("Inputinvestmentss").innerHTML='<input type="text" class="pointer form-control" data-index="0" id="InputInvestment" name="investment[]" placeholder="Please select investment" disabled="">';
}
else{
   $("#statusSelect"+index).val('Please choose Status');
   document.getElementById("InputAlliancess"+index).innerHTML='<input type="text" data-index="'+index+'" class="pointer form-control" id="InputAlliances" name="alliances[]" placeholder="Please select alliances" disabled="">';
   document.getElementById("InputIndustryy"+index).innerHTML='<input data-index="'+index+'" type="text" class="required_for_purpose form-control pointer" id="InputIndustry" name="industry[]" placeholder="Please select your industry" disabled="">';
   document.getElementById("InputSkillss"+index).innerHTML='<input data-index="'+index+'" type="text" class="form-control pointer required_for_purpose" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled="">';
   document.getElementById("Inputfundingss"+index).innerHTML='<input type="text" data-index="'+index+'" class="required_for_purpose pointer form-control" id="InputFunding" name="funding[]" placeholder="Please select funding" disabled="">';
   document.getElementById("Inputinvestmentss"+index).innerHTML='<input type="text" class="pointer form-control" data-index="'+index+'" id="InputInvestment" name="investment[]" placeholder="Please select investment" disabled="">';
}
allpurpose[index].status='';

$("#vision").val('');
$("#InputBusinessContent").val('');
$("#strength").val('');
$("#supplement").val('');





if(value==1)
{
     $("#"+parentID).children().val('');
     $("#"+parentID).children().show();
     $("#"+parentID).children(".investment").hide();
}
else if(value==2)
{
    $("#"+parentID).children().show();
    $("#"+parentID).children(".investment").hide();
} 

else if(value==3)
{
    $("#"+parentID).children().show();
    $("#"+parentID).children(".status").hide();
    $("#"+parentID).children(".investment").hide();
    
}
else if(value==4)
{
    $("#"+parentID).children().hide();
    $("#"+parentID).children(".purpose").show();
    $("#"+parentID).children(".supplement").show();
}
else if(value==5)
{
     $("#"+parentID).children().hide();
     $("#"+parentID).children(".purpose").show();
     $("#"+parentID).children(".supplement").show();
}
else if(value==6)
{
    $("#"+parentID).children().hide();
    $("#"+parentID).children(".purpose").show();
    $("#"+parentID).children(".investment").show();
}

}



$(document).ready(function () {
$('.filter').hide('1000');

// filter for skills

    $(".filter-button_skills").click(function(){
       
        
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
             $('#onskill-hide').hide();
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            $('#onskill-hide').hide();
            
        }
    });

// filter for industry

$(".filter-button_industry").click(function(){
       
        
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
             $('#onindustry-hide').hide();
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            $('#onindustry-hide').hide();
            
        }
    });

// filter for allliances

$(".filter-button_alliances").click(function(){
       
        
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
             $('#onalliances-hide').hide();
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            $('#onalliances-hide').hide();
            
        }
    });
    
});






$("#step-3-register").click(function (e) { 
    e.preventDefault();
    console.log('submit',allpurpose);
    //  $('.required_for_purpose').find('input,select,textarea').each(function(){
    // if($(this).val()=='')
    //          {
    //              requiredDone=false;
    //              alert('fill All required fields.');
    //          }
    //          else{
    //              requiredDone=true;
    //          }
    
    //  });

        var jsonData = JSON.stringify({"purpose": allpurpose});
        $.ajax({
            type: "POST",
            url: "web-api/user/purpose-of-use.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
          $.toast({
            heading: 'Dear User',
            text: response.message,
            position: 'top-right',
            loaderBg: '#0000',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
          });
        var delay = 2000; 
        var url = 'https://nexus.doozycodsystems.com/home.php'
        setTimeout(function(){ window.location = url; }, delay);
            }
            });
    
    
    
    
    
});

// $(".").each(function(){
//  $(this).change(function(){
//  if($(this).val()=='')
//              {
//                 alert('demo');
//                 $("#add_more").hide();
//              }
//              else{
                  
//                  $("#add_more").show();
//              }
//  });
// });


//  $('#fields').find('input,select,div,span,a,textarea').each(function(){
// $(this).change(function() {
//              if($(this).val()=='')
//              {
//                  alert('required');
//              }
//              else{
//                  alert('not required');
//              }
//             });
//  });

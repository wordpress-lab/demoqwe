/**
 * Created by Ontik on 11/26/2017.
 */

function billFormat(ele)
{
   if($(ele).val()==0)
   {

   }

    if($(ele).val() == 1)
    {
        document.getElementById("amount").required = false;
    }

}
function findpaxid(item)
{
    return item.id == this.a;
}

function expensepaxid(item)
{
    return item.id == this.a;
}



$("#pax_calc ,#selec_adv_100").on("change click",function () {

    var newpax;

    allpaxid =$("#selec_adv_100").val();
    var table = document.getElementById("agent_expense_calc");
    table.innerHTML = '';
    if(allpaxid)
    {
        $("body").css("pointer-events", "progress");
        table.innerHTML = '';
        var paxi=0;

            $.ajax( {
                url:appayable,
                data: { paxid: allpaxid,agentid:agent_id},
                type: "GET",/*method type*/
                dataType: "json",
                cache: false,
                async: false,
                complete: function () {
                    $("body").css("cursor", "default");
                },
                success:function(data) {


                         data.forEach(function(element) {
                             var row = table.insertRow(paxi);
                             var cell1 = row.insertCell(0);
                             var cell2 = row.insertCell(1);
                             var cell3 = row.insertCell(2);
                             var cell4= row.insertCell(3);
                             cell1.innerHTML = element.paxid;
                             cell2.innerHTML = element.amount;
                             cell3.innerHTML = element.commisionamount;
                             cell4.innerHTML =parseFloat(element.amount) - parseFloat(element.commisionamount);
                             paxi++;
                         });

                    data.empty();



                },
                error: function (e) {

                },
                complete: function (e,status) {

                }

            });


       }



});



$("#exp_agent").on("change",function () {
     $("#expense_details").css("display","block");
     agent_id= $(this).val();
     if(agent_id!=null)
     {
         $.ajax( {
             url:apiAgent,
             data: { id:agent_id},
             type: "GET",/*method type*/
             dataType: "json",
             success:function(data) {
                 data.account.forEach(function(element) {
                  //   console.log(element.account_name);
                 });
                 $("#agent_div").hide();
                 $("#agent_div").next().text(data.agent.display_name);
                 $("#agent_name_id").val(data.agent.id);
                 $("#item_name").val(data.agent.display_name);
                 $("#scommission").val("SC-"+data.scnumber);
                 $("#payable").val(data.totalpayable-data.com_amount);
         },
             error: function (e) {
                 console.log(e);
             }
         });
     }

});
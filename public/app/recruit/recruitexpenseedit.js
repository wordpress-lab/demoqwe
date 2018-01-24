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



$("#pax_calc").on("click",function () {
   //console.log(agent_id);
  // console.log(alldata);
    var newpax;

    allpaxid =$("#selec_adv_100").val();
    var table = document.getElementById("agent_expense_calc");
    table.innerHTML = '';
    if(allpaxid)
    {

        var paxi=0;

            $.ajax( {
                url:appayable,
                data: { paxid: allpaxid,agentid:agent_id},
                type: "GET",/*method type*/
                dataType: "json",
                async : false,
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





                },
                error: function (e) {
                 console.log(e);
                }
            });

       }



});

window.onload = function () {

    agent_id= $("#agent_name_id").val();
    if(agent_id!=null)
    {

        console.log();
        $.ajax( {
            url:apiAgent,
            data: { id:agent_id},
            type: "GET",/*method type*/
            dataType: "json",
            success:function(data) {

                $("#agent_name_id").val(data.agent.id);
                $("#item_name").val(data.agent.display_name);
                $("#scommission").val("SC-"+data.scnumber);
                $("#payable").val(data.totalpayable-data.com_amount+parseFloat(editsales_commission));



                var am= parseFloat($("#amount").val());
                afterbalance(am);

            },
            error: function (e) {

            }
        });
    }
}

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


                 $("#agent_div").hide();
                 $("#agent_div").next().text(data.agent.display_name);
                 $("#agent_name_id").val(data.agent.id);

                 $("#item_name").val(data.agent.display_name);
                 $("#scommission").val("SC-"+data.scnumber);
                 $("#payable").val(data.totalpayable-data.com_amount);





             },
             error: function (e) {

             }
         });
     }

});
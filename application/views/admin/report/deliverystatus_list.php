<div class="card-box table-responsive" style="width: 100%;">
    <h1 style="text-align: center;"><%-com.name%></h1>
    <div style="text-align: center;"><%-com.address%>,<%-com.city%>,<%-com.state%>,<%-com.zip%></div>
    <div style="text-align: center;">Offer Details</div>
    
    
</div>
<div class="card-box table-responsive" style="width: 100%;">
    <% 
    var offer_no='',tot={q:0,v:0,d:0,tv:0,tx:0};
    for(var k=0;k< row.length;k++) {
 
    if(offer_no!=row[k].offer_no){
       tot={q:0,v:0,d:0,tv:0,tx:0}
    %>
    <div style="width: 100%;text-align: left;padding-top: 10px;font-size: 18px;font-weight: bold;text-decoration: underline;"><span>Offer Number</span> : <%-row[k].offer_no%></div>
            <table  class="table datatable" style="width: 100%;" cellspacing='0'>
                <thead>
                    <tr>
                        <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;">Description & Specification of Goods </th>
                        <th style="text-align: center;border-bottom: 1px solid #354650;padding: .75rem;"> HSN Code </th>
                        <th style="text-align: center;border-top: 1px solid #354650;border-bottom: 1px solid #354650; solid #354650;padding: .75rem;">Quantity</th>
                        <th style="text-align: center;border-bottom: 1px solid #354650;padding: .75rem;"> UOM </th>
                        <th style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;" >Rate Per Unit</th>
                        <th style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;">Discount(%) </th>
                        <th style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;"> GST(%) </th>
                        <th style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;" colspan="2"> GST Amount </th>
                        <th style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;" colspan="2"> Total Value </th>

                       
                    </tr>
                </thead>

                <tbody>
                    <%
                    }
                        offer_no=row[k].offer_no;
                        tv=parseFloat(row[k].quantity)*parseFloat(row[k].rate);
                        tot.q +=parseFloat(row[k].quantity);
                        tot.d += (tv*parseFloat(row[k].discount))/100;
                        tot.tv +=parseFloat(row[k].final_amount);
                        tot.tx +=parseFloat(row[k].tax_amount);
                    
                    %>
                    <tr>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].code%> - <%-row[k].specification%></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].hsn_code%></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].quantity.toFixed(2)%></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].unit%></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].rate.toFixed(2)%></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].discount.toFixed(2)%></td>
                        <td style="text-align: center; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].tax.toFixed(2)%></td>
                        <td style="text-align: right; border-bottom: 1px solid #354650;padding: .75rem;" colspan="2"><%-row[k].tax_amount.toFixed(2)%></td>
                        <td style="text-align: right; border-bottom: 1px solid #354650;padding: .75rem;" colspan="2"><%-row[k].final_amount.toFixed(2)%></td>
                    </tr>
                    <%
                        
                        
                     if(typeof row[k+1] == 'undefined' || offer_no!=row[k+1].offer_no){   
                          
                       %>
                    
                    
                </tbody>
                <tfoot>
                    <tr>
                        
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;" colspan="1">Total:</td>
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;">&nbsp;</td>
                        <td style="border-top: 1px solid #354650;padding: .75rem;"><%-tot.q.toFixed(2)%></td>
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;">&nbsp;</td>
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;">&nbsp;</td>
                        <td style="border-top: 1px solid #354650;padding: .75rem;" ><%-tot.d.toFixed(2)%></td>
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;" colspan="2" >&nbsp;</td>
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;" ><%-tot.tx.toFixed(2)%></td>
                        <td style="text-align: right;border-top: 1px solid #354650;padding: .75rem;" ><%-tot.tv.toFixed(2)%></td>
                        
                    </tr>
                </tfoot>
            </table>
           
            
    <%
    }
    }
    %>
   
    <table  class="datatable1" style="width: 100%;" cellspacing='0'>
            
        <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;" colspan="3">Grand Total</th>
                        <th  style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;"></th>
    </table>
  
    
        </div>

<script src="assets/js/app/report/offerrpt.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        ROFFER.initofferRprtL();
    });
</script>

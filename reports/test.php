Qty1 : <input onblur="findTotal()" type="text" name="qty" id="qty2"/><br>
Qty2 : <input onblur="findTotal()" type="text" name="qty" id="qty2"/><br>
Qty3 : <input onblur="findTotal()" type="text" name="qty" id="qty3"/><br>
Qty4 : <input onblur="findTotal()" type="text" name="qty" id="qty4"/><br>
Qty5 : <input onblur="findTotal()" type="text" name="qty" id="qty5"/><br>
Qty6 : <input onblur="findTotal()" type="text" name="qty" id="qty6"/><br>
Qty7 : <input onblur="findTotal()" type="text" name="qty" id="qty7"/><br>
Qty8 : <input onblur="findTotal()" type="text" name="qty" id="qty8"/><br>
<br><br>
Total : <input type="text" name="total" id="total"/>


    <script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByName('qty');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total').value = tot;
}

    </script>
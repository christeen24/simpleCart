<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    </head>
    <body>
        <div class="container" style="margin-left: 4rem !important">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8" style="border-right: 2px solid #636e72">
                    <div class="row" id="itemBody">
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 style="color: #192a56;">Cart</h3>
                    <br>
                    <table>  
                        <thead>
                            <tr>
                                <th style="padding-left:1rem; padding-bottom:1rem; color: #273c75;">Item Name</th>
                                <th style="padding-left:2rem; padding-bottom:1rem; color: #273c75;">Price</th>
                                <th style="padding-left:2rem; padding-bottom:1rem; color: #273c75;">Quantity</th>
                                <th style="padding-left:2rem; padding-bottom:1rem; color: #273c75;">Sub Total</th>
                                <th style="padding-left:2rem; padding-bottom:1rem;color: #273c75;"></th>
                            </tr>
                        </thead>                          
                        <tbody id="cartBody">
                        
                        </tbody>
                        <tfoot>
                            <td  colspan="4" align="right"  style="color: #192a56; padding-top:2rem;"><h5>Total : </h5></td>
                            <td style="padding-top:2rem;" id="Total"></td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">
        var subTotal = 0;
        var total = 0;
        var itemArray = [
            { "id" : "1", "itemName" : "Black & white top", "itemPrice" : "1690.00"}, 
            { "id" : "2", "itemName" : "Pink callie dress", "itemPrice" : "3990.00" }, 
            { "id" : "3", "itemName" : "Mesh detailed top", "itemPrice" : "1790.00" }, 
            { "id" : "4", "itemName" : "Off shoulder maxi", "itemPrice" : "2900.00" }, 
            { "id" : "5", "itemName" : "Pastel pink romper", "itemPrice" : "2790.00" }
        ];

        var cartItemArray = [];
        
        $.each(itemArray,function(key,value){
            $('#itemBody').append(
                '<div class="col-md-4">'
                    +'<div class="card-deck">'
                        +'<div class="card" style="width: 12rem; margin-bottom:1rem;">'
                            +'<img src="https://dummyimage.com/400x250/000/fff" class="card-img-top" alt="...">'
                            +'<div class="card-body">'
                                +'<h6 class="card-title" style="text-align:center">'+value.itemName+'</h6>'
                                +'<h6 class="card-title" style="text-align:center">Rs. '+value.itemPrice+'</h6>'
                                +'<a href="#" class="btn btn-primary btn-sm" style="margin:auto; display:block" onclick="addToCart('+value.id+')"><i class="fa fa-cart-plus"></i></a>'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                +'</div>'
            );
        });

        function addToCart(id) {
            // console.log(id);
            $.each(itemArray,function(key,value){
                if(value.id==id){
                    $_exist = $.grep(cartItemArray, function(e){ return e.id == id; });

                    if($_exist.length==0){
                        value['quantity'] = 0;
                        value['subTotal'] = 0.00;
                        value['total'] = 0.00;
                        cartItemArray.push(value);
                    }
                    
                };
            });
            drawCart();
        }

        function drawCart(){
            $('#cartBody').html('');
            $.each(cartItemArray,function(key,value){
                $('#cartBody').append(
                        '<tr style="padding-bottom:1reml;">'
                            +'<td style="padding-left:1rem; color: "><h6>'+value.itemName+'</h6></td>'
                            +'<td style="padding-left:2rem; color:#353b48; "><h6>Rs.'+value.itemPrice+'</h6></td>'
                            +'<td style="padding-left:2rem; color:#353b48; ">'
                            +'<input type="number" style="width:50px; name="quantity" id="quantity_'+value.id+'" onchange="calculateCart('+value.id+')" value="'+value.quantity+'">'
                            +'</td>'
                            +'<td style="padding-left:2rem; color:#353b48; "><h6>Rs.'+value.subTotal+'</h6></td>'
                            +'<td style="padding-left:2rem; color:#353b48; "><a href="#" class="btn btn-danger btn-sm" onclick="deleteFromCart('+value.id+')"><i class="fa fa-close"></i></a></td>'
                        +'</tr>'
                );   
            });
        }

        function calculateCart(id){
            // console.log(cartItemArray);
            tmp_qty = $('#quantity_'+id).val();

            $.each(cartItemArray,function(key,value){
                if(value.id==id){
                    value.quantity = tmp_qty;
                    value.subTotal = value.quantity*value.itemPrice;
                }
            });

            var totalOfAllItems = cartItemArray.reduce(function(prev, cur) {
                return prev + cur.subTotal;
            }, 0);

            if(cartItemArray.length==0) {
                total = 0
            }
            else if(cartItemArray.length>=1){
                console.log('Total:', totalOfAllItems);
                total = totalOfAllItems;
            }
            
            $('#Total').html('');
            $('#Total').append(
                '<h5 style="color:#192a56;">Rs.'+total+'</h5>'
            );

            drawCart();
            console.log(cartItemArray);
        }

        function deleteFromCart(id){
            tmp_i = '';
            $.each(cartItemArray,function(key,value){
                if(value.id==id){
                    tmp_i = key;
                }
            });
            cartItemArray.splice(tmp_i,1);
            calculateCart();
            drawCart();
            
        }


    </script>
</html>
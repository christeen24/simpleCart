<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    </head>
    <body>
        <div class="container" style="margin-left: 2rem !important">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8" style="border-right: 2px solid #636e72">
                    <div class="row" id="itemBody">
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 style="color: #192a56; margin-left: 1rem">Cart</h3>
                    <br>
                    <table style="margin-left: 1rem">  
                        <thead>
                            <tr style="border-bottom: 2px solid #636e72">
                                <th style="padding-left:1rem; padding-bottom:1rem; color: #273c75;">Item Name</th>
                                <th style="padding-left:2rem; padding-bottom:1rem; color: #273c75;">Price</th>
                                <th style="padding-left:2rem; padding-bottom:1rem; color: #273c75;">Quantity</th>
                                <th style="padding-left:2rem; padding-bottom:1rem; color: #273c75;">Sub Total</th>
                                <th style="padding-left:2rem; padding-bottom:1rem;color: #273c75;"></th>
                            </tr>
                        </thead>                          
                        <tbody id="cartBody">
                            <tr>
                                <td colspan="5" style="padding:1rem">
                                    <h6 class="text-muted">No Items</h6>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot style="border-top: 2px solid #636e72">
                            <td colspan="4" align="left"  style="color: #192a56; padding-top:2rem;"><h5>Total  </h5></td>
                            <td style="padding-top:2rem;" id="Total"><h5 style="color:#192a56;">Rs.0.00</h5></td>
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
            { "id" : "1", "itemName" : "Black & white top", "itemPrice" : (1690.00).toLocaleString(), "img" :"https://d2bnh4l4ivgux0.cloudfront.net/unshoppable_producs/cbee80b2-580e-4db7-99c7-6179dd29c9de.png"}, 
            { "id" : "2", "itemName" : "Pink callie top", "itemPrice" : (3990.00).toLocaleString(), "img":"https://data.whicdn.com/images/310543828/large.jpg" }, 
            { "id" : "3", "itemName" : "Mesh detailed top", "itemPrice" : (1790.00).toLocaleString(), "img":"https://ak0.scstatic.net/1/bigimg-cdn1-cont15.sweetcouch.com/152412320400168798-girl-flutter-sleeve-top.png" }, 
            { "id" : "4", "itemName" : "Unicorn printed Top", "itemPrice" : (2900.00).toLocaleString(), "img":"https://static1.squarespace.com/static/5aea0eb1f2e6b1c807bf4a93/5cc2005bb208fc3f97fb622d/5d65698966ff7600012fdffa/1567385024449/?format=750w" }, 
            { "id" : "5", "itemName" : "Lightblue Sleeveless Top", "itemPrice" : (2790.00).toLocaleString(), "img":"https://cdn.shoplightspeed.com/shops/607203/files/13318071/262x276x2/roxy-ivy-tank.jpg" }
        ];

        var cartItemArray = [];
        
        $.each(itemArray,function(key,value){
            $('#itemBody').append(
                    '<div class="card-deck">'
                        +'<div class="card" style="width: 10rem; height:13rem; margin-bottom:1rem; margin-right:2rem">'
                            +'<img src="'+value.img+'" width="100px" height="115px" class="card-img-top" alt="...">'
                            +'<div class="card-body" style="padding:0.1rem;">'
                                +'<p class="card-title" style="text-align:center; font-size:0.8rem; margin-bottom:0rem">'+value.itemName+'</p>'
                                +'<p class="card-title" style="text-align:center; font-size:0.8rem;">Rs. '+value.itemPrice+'.00</p>'
                                +'<a href="#" class="btn btn-primary btn-sm" style="margin-left:2rem; margin-right:2rem; display:block" onclick="addToCart('+value.id+')"><i class="fa fa-cart-plus"></i></a>'
                            +'</div>'
                        +'</div>'
                    +'</div>'
            );
        });

        function addToCart(id) {
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
            if(cartItemArray.length==0){
                $('#cartBody').append(
                    '<tr>'
                        +'<td colspan="5" style="padding:1rem">'
                            +'<h6 class="text-muted">No Items</h6>'
                        +'</td>'
                    +'</tr>'
                )
            }else{
                $.each(cartItemArray,function(key,value){
                    $('#cartBody').append(
                            '<tr style="padding-bottom:1rem; border-bottom: 2px solid #636e72">'
                                +'<td style="padding-left:1rem; color: "><h6>'+value.itemName+'</h6></td>'
                                +'<td style="padding-left:2rem; color:#353b48; "><h6>Rs.'+value.itemPrice+'.00</h6></td>'
                                +'<td style="padding-left:2rem; color:#353b48; ">'
                                    +'<input class="form-control" type="number" name="quantity" id="quantity_'+value.id+'" oninput="calculateCart('+value.id+')" value="'+value.quantity+'">'
                                +'</td>'
                                +'<td style="padding-left:2rem; color:#353b48; "><h6>Rs.'+value.subTotal+'.00</h6></td>'
                                +'<td style="padding-left:2rem; color:#353b48; "><a href="#" onclick="deleteFromCart('+value.id+')"><i class="fa fa-trash" style="color:red; font-size: 1.5rem;"></i></a></td>'
                            +'</tr>'
                    );   
                });                
            }

        }

        function calculateCart(id){
            tmp_qty = $('#quantity_'+id).val();

            $.each(cartItemArray,function(key,value){
                if(value.id==id){
                    value.quantity = tmp_qty;
                    itemprice = Number(value.itemPrice.replace(/[^0-9.-]+/g,""));
                    value.subTotal = (value.quantity*itemprice);
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
                total = (totalOfAllItems).toLocaleString();
            }
            
            $('#Total').html('');
            $('#Total').append(
                '<h5 style="color:#192a56;">Rs.'+total+'.00</h5>'
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
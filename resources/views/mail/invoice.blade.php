<html>

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;padding: 15px 0px;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #f20f38;">
    <thead>
      <tr>
        <th style="text-align:left;"><img style="max-width: 100px;" src="https://zakerdairyfarm.com//assets/admin/img/footer-logo/1652853556.png" alt="zaker dairy"></th>
        <th style="text-align:right;font-weight:400;">{{$user["created_at"]}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:green;font-weight:normal;margin:0">Pending</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order ID</span> {{$user["order_id"]}}</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span>{{$data->totalPrice}}</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> {{$user["name"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$user["email"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$user["phone"]}}</p>
        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> {{$user["address"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Shipping Address</span> {{$user["shipment"]}}</p>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
      </tr>
      <tr>
        <td colspan="2" style="padding:15px;">
          @foreach ($data->items as $item)
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
              <span style="display:block;font-size:13px;font-weight:300;">
                {{$item['item']['name']}}
              </span> 
              {{$item['qty']}} x {{$item['item']['price']}}&nbsp;tk
              <b style="font-size:12px;"></b>
            </p>
          @endforeach
        </td>
      </tr>
    </tbody>
    <tfooter>
      <tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
          <strong style="display:block;margin:0 0 10px 0;">Regards</strong>
            Zaker Dairy Farm
          <br> 
          28/1, Road: 3/B, Mohammadia Housing, Mohammadpur, Dhaka 
          <br><br>
          <b>Phone:</b> 01676-083713<br>
          <b>Email:</b>zakerdairy@gmail.com
        </td>
      </tr>
    </tfooter>
  </table>
</body>

</html>
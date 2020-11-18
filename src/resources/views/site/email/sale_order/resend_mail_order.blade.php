<div style="background: #FFFFFF; border-radius: 3px;">
    <div style="overflow:hidden">
        <div style="font-family:Verdana,Geneva,sans-serif;color:rgb(102,102,102);font-size:15px">
            <p style="color: #000000;">
                Hi, {{ $sale_order['billing_fullname'] }}
            </p>

            <p>Cám ơn bạn đã đặt mua sản phẩm của chúng tôi tại&nbsp;
                <a href="{{ base_url() }}" target="_blank">{{ $company_name }}</a>.
            </p>
            <p>Dưới đây là thông tin chi tiết về đơn hàng của bạn:</p>
            <p style="color:rgb(0,102,204);font-size:16px">Mã đơn hàng: {{ $sale_order['code'] }} (vui
                lòng ghi chú mã đơn hàng này khi thanh toán)</p>
            <p>Các sản phẩm đã đặt mua:</p>
            <table width="100%" border="1" style="border-collapse:collapse">
                <tbody>
                <tr>
                    <td width="20px" height="30px" valign="middle" align="center">STT</td>
                    <td width="80px" height="30px" valign="middle" align="center">Mã SP</td>
                    <td width="150px" height="30px" valign="middle" align="center">Tên SP</td>
                    <td width="50px" height="30px" valign="middle" align="center">Số lượng</td>
                    <td width="150px" height="30px" valign="middle" align="center">Giá</td>
                    <td width="150px" height="30px" valign="middle" align="center">Thành tiền</td>
                </tr>
                @if(!empty($sale_order_line))
                    @foreach($sale_order_line as $key => $line)
                        <tr>
                            <td valign="middle" align="center">{{ $key+ 1 }}</td>
                            <td valign="middle" align="center">{{ $line['product_sku'] }}</td>
                            <td valign="middle" align="center">{{ $line['product_name'] }}</td>
                            <td valign="middle" align="center">{{ $line['quantity'] }}</td>
                            <td valign="middle" align="center">{{ number_format($line['item_price_sell']) }}</td>
                            <td valign="middle" align="center">{{ number_format($line['sub_total']) }}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td height="30" colspan="5" align="right">
                        <strong>Tổng giá:</strong>
                    </td>
                    <td height="30" align="center">
                        <strong>{{ number_format($sale_order['price_sell']) }}</strong>
                    </td>
                </tr>
                </tbody>
            </table>
            <p style="color:rgb(0,102,204);font-size:16px">
                <strong>Tổng giá trị đơn hàng:</strong>&nbsp;{{ number_format($sale_order['price_final']) }} vnđ
            </p>
            <p>
                <strong>Hình thức thanh toán:</strong>&nbsp;Giao hàng thu tiền tận nơi
            </p>
            <p>
                <strong>Hướng dẫn thanh toán:&nbsp;</strong>
                <a href="{{ base_url() }}" target="_blank">Xem hướng dẫn thanh toán</a>
            </p>
            <p style="color:rgb(0,102,204);font-size:16px">
                <strong>Thông tin người thanh toán:</strong>
            </p>
            <ul>
                <li style="margin-left:15px">
                    <strong>Họ và Tên:&nbsp;</strong> {{ $sale_order['billing_fullname'] }}
                </li>
                <li style="margin-left:15px">
                    <strong>Địa chỉ:</strong>&nbsp; {{ $sale_order['billing_address'] }}
                </li>
                <li style="margin-left:15px">
                    <strong>Điện thoại:</strong>&nbsp; {{ $sale_order['billing_phone'] }}
                </li>
                <li style="margin-left:15px">
                    <strong>Email:&nbsp;</strong>
                    <a href="mailto:{{ $sale_order['billing_email'] }}"
                       target="_blank">{{ $sale_order['billing_email'] }}</a>
                </li>
                <li style="margin-left:15px">
                    <strong>Ghi chú:</strong>
                    <p>
                        {!!nl2br(str_replace(" ", " &nbsp;", $sale_order['note']))!!}
                    </p>
                </li>
            </ul>
            <p style="color:rgb(0,102,204);font-weight:bold">Khi thanh toán, bạn nhớ ghi rõ MÃ ĐƠN HÀNG và TÊN của mình
                để tránh nhầm lẫn.</p>

            <p style="border-bottom: 1px dashed #ccc; padding-bottom: 15px">Thank you for submitting! </p>
            <strong>Best regards,</strong><br/>
            {{ $company_name }} Team
            </p>
        </div>
    </div>
</div>
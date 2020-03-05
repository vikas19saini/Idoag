<table  class="table">
    <thead>
    <tr>
        <th>S No</th>
        <th>Brand</th>
        <th>Offer</th>
        <th>User</th>
        <th>College</th>
        <th>Coupon</th>
        <th>Coupon Type</th>
        <th>Date Used</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coupons as $key => $coupon)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ getBrandName($coupon->post->brand_id)}}</td>
            <td>{{ $coupon->post->name}}</td>
            <td>{{ getUserName($coupon->user_id) }}</td>
            <td>{{getUserInstitute($coupon->user_id)}}</td>
            <td>{{ $coupon->code}}</td>
            <td>{{ $coupon->post->voucher_type}}</td>
            <td>{{ $coupon->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

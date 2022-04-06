@component('mail::message')
# Hello {{ $order->user->fname }},

Your order details
<table>
<thead>
<tr>
<th>Product Name </th>
<th>Product Price </th>
</tr>
</thead>
<tbody>
@foreach ($order->products as $item)
<tr> <td> {{ $item->name }}</td>
<td> {{ $item->price }} </td> </tr>
@endforeach
</tbody>
<tr> <td colspan="2"> Order total cost: {{ $order->total_cost }} </td> </tr>
</table>
<br>
Your order has been placed successfully

@component('mail::button', ['url' => 'http://localhost:4200/'])
Shop More
@endcomponent

Thanks,<br>
    {{ config('app.name') }}
@endcomponent



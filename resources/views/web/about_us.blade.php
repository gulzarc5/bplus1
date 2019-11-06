@extends('web.templet.master')

@section('title', 'aboutus')



@section('content')
<div class="container">
  <header class="page-header">
    <h1 class="page-title" style="font-size: 40px;">About Us
    </h1>
  </header>
  <div class="row">
    <div class="col-md-9">
    </div>
  </div>
  <div class="gap gap-small">
  </div>
  <div class="row row-col-gap">
    <div class="col-md-7">
      <img class="full-width" src="{{asset('src/img/about.png')}}" alt="Image Alternative text" title="Image Title" />
    </div>
    <div class="col-md-5">
      <!-- <h3 class="widget-title"></h3> -->
      <p style="text-align: justify;">
        <strong>Bplus
        </strong> is a network centric B2B trade platform, designed specifically for small & medium businesses in India. It brings traders, wholesalers, retailers and manufacturers in India on to a single platform. With real insights into active trends, and great B2B trade features, 
        <strong>Bplus
        </strong> brings to its users the power of technology to scale & nurture their business.
      </p>
      <p>The easy-to-use app gives you the power to:
      <ul>
        <li>DISCOVER customers, suppliers and products across numerous categories
        </li>
        <li style="margin-top: 10px;">CONNECT directly with parties of interest and discuss trade
        </li>
        <li style="margin-top: 10px;">BUY & SELL on your terms – with secure payments and smooth logistics
        </li>
        <li style="margin-top: 10px;">GROW your network through repeats and relationships with like-minded parties
        </li>
      </ul>
      </p>
  </div>
</div>
<div class="gap gap-small">
</div>
<div class="row row-col-gap" style="margin-top: -30px;">
  <div class="col-md-12">
    <h4 >DISCOVER
    </h4>
    <p>With 
      <strong>Bplus
      </strong>, traders can reach out to buyers and sellers across the country. This is where you can join more than 1,50,000+ buyers and sellers from 29 states, in finding the right match for the product or market you seek.
    </p>
  </div>
</div>
<div class="gap gap-small">
</div>
<div class="row row-col-gap" style="margin-top: -30px;">
  <div class="col-md-12">
    <h4 >CONNECT
    </h4>
    <p>On 
      <strong>Bplus
      </strong>, you connect directly with a buyer or seller. Just like in your own shop. You can discuss the product, and negotiate terms of credit directly with the buyer/seller. The chat feature allows you to have a personal and secure conversation in real-time, in language of your choice.
    </p>
  </div>
</div>
<div class="gap gap-small">
</div>
<div class="row row-col-gap" style="margin-top: -30px;">
  <div class="col-md-12">
    <h4 >BUY & SELL
    </h4>
    <p>Make a purchase with the tap of a button. It’s the same if you wish to post a product you want to sell: tap, then add the details. Everything from there is a smooth ride. 
      <strong>Bplus
      </strong> facilitates secure payments and arranges for quick logistics.
    </p>
  </div>
</div>
<div class="gap gap-small">
</div>
<div class="row row-col-gap" style="margin-top: -30px;">
  <div class="col-md-12">
    <h4 >GROW
    </h4>
    <p>
      <strong>Bplus
      </strong> is a platform for you to grow your network for future business, even as you buy and sell. By making use of 
      <strong>Bplus's
      </strong> intuitive features - MyBiz, Feed, Share, Connections – you can grow your presence, create interest in your brand, and set the stage for growth.
    </p>
  </div>
</div>
</div>
@endsection
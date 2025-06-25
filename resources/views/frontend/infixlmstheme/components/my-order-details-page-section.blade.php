<div>
    <section class="admin-visitor-area up_st_admin_visitor pt-5 mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-9">


                    <!-- invoice print part here -->
                    <div class="invoice_print pb-5">
                        <div class="container-fluid p-0">
                            <div id="invoice_print" class="invoice_part_iner">

                                <style>

                                    .invoice_part_iner h4 {
                                        font-size: 20px;
                                    }

                                    .order_details_progress {
                                        display: flex;
                                        margin: 40px 0 75px 0;
                                        position: relative;
                                    }

                                    .order_details_progress .single_order_progress:not(:last-child)::before {
                                        content: "";
                                        position: absolute;
                                        left: calc(50% + 20px);
                                        height: 1px;
                                        background: #f1ece8;
                                        top: 15px;
                                        right: calc(-50% + 20px);
                                    }

                                    .order_details_progress .single_order_progress {
                                        flex: 1 0 0;
                                    }

                                    .thumb {
                                        width: 100px !important;
                                    }

                                    .thumb img {
                                        height: 90px;
                                    }

                                    .theme_select:after {
                                        right: 33px;
                                        top: 25px;
                                        color: #afafaf;
                                        font-size: 12px;
                                    }

                                    @media print {
                                        .table {
                                            width: 100%;
                                            margin-bottom: 1rem;
                                            color: #212529;
                                            font-family: Jost, sans-serif;
                                        }

                                        td h3 {
                                            font-size: 24px;
                                            font-weight: 500;
                                            color: var(--system_secendory_color);
                                        }

                                        .w-50 {
                                            width: 50% !important;
                                        }

                                        .invoice_grid {
                                            display: grid;
                                            grid-template-columns: 90px auto;
                                            margin-bottom: 10px;
                                            grid-gap: 25px;
                                        }

                                        h4 {
                                            line-height: 25px;
                                        }

                                        .custom_table3 {
                                            border-radius: 5px;
                                            background-color: red;
                                        }

                                        .custom_table3 tr {
                                            border-bottom: 1px solid #f1f2f3;
                                        }

                                        .table tr th {
                                            background-color: #fafafa !important;
                                        }

                                        .table thead th {
                                            vertical-align: bottom;
                                        }

                                        .table.custom_table3 thead tr th {
                                            font-weight: 600;
                                            border-top: 0;
                                            font-family: Cerebri Sans;
                                            padding: 15px 30px 15px 0;
                                        }

                                        .table.custom_table3 tbody tr td,
                                        .table.custom_table3 thead tr th {
                                            font-size: 16px;
                                            color: #373737;
                                            white-space: nowrap;
                                        }

                                        th p span,
                                        td p span {
                                            color: #212E40;
                                        }

                                        .text-end {
                                            text-align: right !important;
                                        }

                                    }
                                </style>

                                </table>
                                {{-- tracking start --}}
                                <div class="dashboard_white_box_body dashboard_orderDetails_body">

                                    @php
                                        use Carbon\Carbon;use Modules\CourseSetting\Entities\CourseEnrolled;
                                        $p_total = 0;
                                        $p_qty = 0;
                                    @endphp
                                    @foreach ($packages as $key => $package)
                                        <div
                                            class="order_prise d-flex justify-content-between gap-2 flex-wrap amazy_bb2 pb_11 mb_10">
                                            <h4 class="font_16 f_w_700 m-0">{{__('product.Package')}}
                                                : {{ $package->package_code }}</h4>

                                            <h4 class="font_16 f_w_700 m-0">{{__('product.sold_by')}}
                                                : {{ $package->seller->name }} </h4>

                                            @if($package->delivery_status==4)
                                                <div class="form-check">
                                                    <label class="primary_checkbox d-flex">
                                                        <input type="checkbox" class="attr_checkbox" value="1"
                                                               id="is_received" data-package_id="{{$package->id}}"
                                                               data-id="{{$order->id}}">
                                                        <span class="checkmark mr_10"></span>
                                                        <span
                                                            class="label_name f_w_700">{{__('product.Is Received?')}}</span>
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                        @if($package->is_cancelled == 0)
                                            <p class="font_14 f_w_400">{{ $package->shipping_date }}</p>
                                            <div class="order_details_progress ">
                                                @if($package->carrier->slug == 'Shiprocket')
                                                    @php
                                                        $status = $order_status[$package->id];
                                                        $ready_to_ship = false;
                                                        $pickup= false;
                                                        $ship= false;
                                                        $delivered= false;
                                                        switch ($status){
                                                            case "READY TO SHIP":
                                                                $ready_to_ship = true;
                                                                break;
                                                            case 'PICKUP':
                                                            $ready_to_ship = true;
                                                            $pickup= true;
                                                            break;
                                                            case 'SHIPPED':
                                                            $ready_to_ship = true;
                                                            $pickup= true;
                                                            $ship= true;
                                                            break;
                                                            case 'DELIVERED':
                                                            $ready_to_ship = true;
                                                            $pickup= true;
                                                            $ship= true;
                                                            $delivered= true;
                                                            break;
                                                        }
                                                    @endphp
                                                    <div
                                                        class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                        <div class="icon position-relative order_process_icon">
                                                            @if ($package->delivery_status >= 1)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <circle data-name="Ellipse 239" cx="15" cy="15"
                                                                                r="15" transform="translate(613 335)"
                                                                                fill="#50cd89"></circle>
                                                                        <path data-name="Path 4193"
                                                                              d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z"
                                                                              transform="translate(530.651 338.622)"
                                                                              fill="#fff"></path>
                                                                    </g>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#f1ece8" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#f1ece8"></circle>
                                                                    </g>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <h5 class="font_14 f_w_500 m-0 text-nowrap">{{__('common.pending')}}</h5>
                                                    </div>
                                                    <div
                                                        class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                        <div class="icon position-relative order_process_icon">
                                                            @if ($ready_to_ship)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <circle data-name="Ellipse 239" cx="15" cy="15"
                                                                                r="15" transform="translate(613 335)"
                                                                                fill="#50cd89"></circle>
                                                                        <path data-name="Path 4193"
                                                                              d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z"
                                                                              transform="translate(530.651 338.622)"
                                                                              fill="#fff"></path>
                                                                    </g>
                                                                </svg>
                                                            @elseif($package->delivery_status >= 1 && !$ready_to_ship)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#50cd89" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#50cd89"></circle>
                                                                    </g>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#f1ece8" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#f1ece8"></circle>
                                                                    </g>
                                                                </svg>
                                                            @endif

                                                        </div>
                                                        <h5 class="font_14 f_w_500 m-0 text-nowrap">{{__('shipping.ready_to_ship')}}</h5>
                                                    </div>
                                                    <div
                                                        class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                        <div class="icon position-relative order_process_icon">
                                                            @if ($pickup)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <circle data-name="Ellipse 239" cx="15" cy="15"
                                                                                r="15" transform="translate(613 335)"
                                                                                fill="#50cd89"></circle>
                                                                        <path data-name="Path 4193"
                                                                              d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z"
                                                                              transform="translate(530.651 338.622)"
                                                                              fill="#fff"></path>
                                                                    </g>
                                                                </svg>
                                                            @elseif($ready_to_ship && !$pickup)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#50cd89" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#50cd89"></circle>
                                                                    </g>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#f1ece8" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#f1ece8"></circle>
                                                                    </g>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <h5 class="font_14 f_w_500 m-0 mute_text  text-nowrap">{{__('shipping.pickup')}}</h5>
                                                    </div>
                                                    <div
                                                        class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                        <div class="icon position-relative order_process_icon">
                                                            @if ($ship)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <circle data-name="Ellipse 239" cx="15" cy="15"
                                                                                r="15" transform="translate(613 335)"
                                                                                fill="#50cd89"></circle>
                                                                        <path data-name="Path 4193"
                                                                              d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z"
                                                                              transform="translate(530.651 338.622)"
                                                                              fill="#fff"></path>
                                                                    </g>
                                                                </svg>
                                                            @elseif($pickup && !$ship)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#50cd89" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#50cd89"></circle>
                                                                    </g>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#f1ece8" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#f1ece8"></circle>
                                                                    </g>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <h5 class="font_14 f_w_500 m-0 mute_text text-nowrap">{{__('common.shipped')}}</h5>
                                                    </div>
                                                    <div
                                                        class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                        <div class="icon position-relative order_process_icon">
                                                            @if ($delivered)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <circle data-name="Ellipse 239" cx="15" cy="15"
                                                                                r="15" transform="translate(613 335)"
                                                                                fill="#50cd89"></circle>
                                                                        <path data-name="Path 4193"
                                                                              d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z"
                                                                              transform="translate(530.651 338.622)"
                                                                              fill="#fff"></path>
                                                                    </g>
                                                                </svg>
                                                            @elseif($ship && !$delivered)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#50cd89" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#50cd89"></circle>
                                                                    </g>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                     height="30" viewBox="0 0 30 30">
                                                                    <g data-name="1" transform="translate(-613 -335)">
                                                                        <g data-name="Ellipse 239"
                                                                           transform="translate(613 335)" fill="none"
                                                                           stroke="#f1ece8" stroke-width="2">
                                                                            <circle cx="15" cy="15" r="15"
                                                                                    stroke="none"></circle>
                                                                            <circle cx="15" cy="15" r="14"
                                                                                    fill="none"></circle>
                                                                        </g>
                                                                        <circle data-name="Ellipse 240" cx="5" cy="5"
                                                                                r="5" transform="translate(623 345)"
                                                                                fill="#f1ece8"></circle>
                                                                    </g>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <h5 class="font_14 f_w_500 m-0 mute_text text-nowrap">{{__('order.delivered')}}</h5>
                                                    </div>
                                                @else
                                                    @php
                                                        $next_step = null;
                                                    @endphp
                                                    @foreach ($processes as $key => $process)
                                                        <div
                                                            class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                            <div class="icon position-relative order_process_icon">

                                                                @if ($package->delivery_status >= $process->id)
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                         height="30" viewBox="0 0 30 30">
                                                                        <g data-name="1"
                                                                           transform="translate(-613 -335)">
                                                                            <circle data-name="Ellipse 239" cx="15"
                                                                                    cy="15" r="15"
                                                                                    transform="translate(613 335)"
                                                                                    fill="#50cd89"></circle>
                                                                            <path data-name="Path 4193"
                                                                                  d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z"
                                                                                  transform="translate(530.651 338.622)"
                                                                                  fill="#fff"></path>
                                                                        </g>
                                                                    </svg>
                                                                    @php
                                                                        $next_step = $key + 1;
                                                                    @endphp
                                                                @else
                                                                    @if($next_step == $key)
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="30" height="30" viewBox="0 0 30 30">
                                                                            <g data-name="1"
                                                                               transform="translate(-613 -335)">
                                                                                <g data-name="Ellipse 239"
                                                                                   transform="translate(613 335)"
                                                                                   fill="none" stroke="#50cd89"
                                                                                   stroke-width="2">
                                                                                    <circle cx="15" cy="15" r="15"
                                                                                            stroke="none"></circle>
                                                                                    <circle cx="15" cy="15" r="14"
                                                                                            fill="none"></circle>
                                                                                </g>
                                                                                <circle data-name="Ellipse 240" cx="5"
                                                                                        cy="5" r="5"
                                                                                        transform="translate(623 345)"
                                                                                        fill="#50cd89"></circle>
                                                                            </g>
                                                                        </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="30" height="30" viewBox="0 0 30 30">
                                                                            <g data-name="1"
                                                                               transform="translate(-613 -335)">
                                                                                <g data-name="Ellipse 239"
                                                                                   transform="translate(613 335)"
                                                                                   fill="none" stroke="#f1ece8"
                                                                                   stroke-width="2">
                                                                                    <circle cx="15" cy="15" r="15"
                                                                                            stroke="none"></circle>
                                                                                    <circle cx="15" cy="15" r="14"
                                                                                            fill="none"></circle>
                                                                                </g>
                                                                                <circle data-name="Ellipse 240" cx="5"
                                                                                        cy="5" r="5"
                                                                                        transform="translate(623 345)"
                                                                                        fill="#f1ece8"></circle>
                                                                            </g>
                                                                        </svg>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <h5 class="font_14 f_w_500 m-0 text-nowrap">{{ $process->name }}</h5>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div
                                                class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border mb-5">
                                                <div class="d-flex flex-column ">
                                                    <div class="d-flex align-items-center flex-wrap gap_5">
                                                        <h4 class="font_14 f_w_500 m-0 lh-base">{{__('product.package_code')}}
                                                            : </h4>
                                                        <p class="font_14 f_w_400 m-0 lh-base"> {{ $package->package_code }}</p>
                                                    </div>
                                                </div>
                                                {{-- <div class="d-flex flex-column  ">
                                                    <div class="d-flex align-items-center flex-wrap gap_5">
                                                        <h4 class="font_14 f_w_500 m-0 lh-base">{{__('product.order_amount')}}: </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ getPriceFormat($package->product->sum('total_price')) }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column  ">
                                                    <div class="d-flex align-items-center flex-wrap gap_5">
                                                        <h4 class="font_14 f_w_500 m-0 lh-base">{{__('product.tax_amount')}}:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> {{ single_price($package->tax_amount) }}</p>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        @else
                                            <div
                                                class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                                <h5 class="text-danger mt_20 w-100 text-center">{{__('product.order_cancelled')}}</h5>
                                            </div>
                                        @endif
                                        <div class="table-responsive mb-3">
                                            <table class="table amazy_table3 style2 mb-0">
                                                <tbody>
                                                @php
                                                    $physical_product = 0;
                                                    $total = 0;
                                                    $qty = 0;
                                                    $all_product = Modules\Store\Entities\OrderPackageDetail::where(['order_id' => $enroll->id , 'seller_id' => $package->seller_id])->get();
                                                @endphp
                                                @foreach ($all_product as $key => $package_product)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ courseDetailsUrl(@$package_product->course->id, @$package_product->course->type, @$package_product->course->slug) }}"
                                                               class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img class="img-fluid"
                                                                         src="{{ getCourseImage($package_product->course->thumbnail) }}"
                                                                         alt="" title="">
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="summery_pro_content">
                                                                <h5 class="font_16 f_w_700 text-nowrap m-0 theme_hover">{{ @$package_product->course->title }}</h5>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="font_16 f_w_500 m-0 text-nowrap">{{__('product.qty')}}
                                                                : {{ $package_product->number_of_product }}</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class="font_16 f_w_500 m-0 text-nowrap">
                                                                @php
                                                                    $price = $package_product->course->discount_price != 0 ? $package_product->course->discount_price : $package_product->course->price;

                                                                   if ($package_product->is_store == 1) {
                                                                       if ($package_product->course->product->type == 2 && $package_product->course->product->has_variant == 1) {
                                                                         $price1 =  CourseEnrolled::where('course_id',$package_product->course_id)
                                                                        ->where('user_id',auth()->id())
                                                                        ->where('tracking',$package_product->order->tracking)
                                                                        ->first()
                                                                        ->purchase_price;
                                                                         }else{
                                                                       $price1 = $package_product->course->discount_price != 0 ? $package_product->course->discount_price : $package_product->course->price;
                                                                       }
                                                                       $price = $price1 * $package_product->number_of_product;

                                                                   } else {
                                                                       $price = $package_product->course->discount_price != 0 ? $package_product->course->discount_price : $package_product->course->price;
                                                                       $price1 = $price;
                                                                   }
                                                                   $total = $total + $price;
                                                                   $qty = $qty+$package_product->tax_amount;
                                                                @endphp
                                                                {{ getPriceFormat($price,false) }}
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @php
                                                    $p_total = $p_total + $total;
                                                    if (isModuleActive('Tax')) {
                                                        $p_qty = $p_qty + $qty;
                                                    }
                                                @endphp
                                                </tbody>
                                            </table>
                                            <div class="d-flex flex-column mt_10">
                                                <div
                                                    class="d-flex align-items-center flex-wrap gap_5 justify-content-end">
                                                    @if ($order->is_confirmed == 0 && $package->is_cancelled == 0 || $order->is_confirmed == 1 && $package->is_cancelled == 0 && $package->delivery_status <= 2)
                                                        <a href="javascript:void(0)"
                                                           data-id="{{ $package->id }}" class="amaz_primary_btn
                                                           gray_bg_btn radius_3px order_cancel_by_id
                                                        ">{{__('product.cancel_order')}}</a>
                                                    @elseif ( $package->delivery_status >= 5)
                                                        @if (\Carbon\Carbon::now() <= $order->created_at->addDays(Settings('refund_times')) && $package->is_cancelled == 0 && $package->course->product->type == 2 && !$package->refundPackage && Settings('refund_status'))
                                                            <a href="{{ route('refund.make_request', encrypt($package->id)) }}"
                                                               class="amaz_primary_btn gray_bg_btn radius_3px">{{__('product.open_dispute')}}</a>
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>


                                        @if($package->carrier->type == 'Manual' && $package->carrier_order_id)
                                            <div
                                                class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                                <div class="d-flex flex-column ">
                                                    <div class="d-flex align-items-center flex-wrap gap_5">
                                                        <h4 class="font_14 f_w_500 m-0 lh-base">{{__('shipping.shipping_by')}}
                                                            : </h4>
                                                        <p class="font_14 f_w_400 m-0 lh-base"> {{@$package->carrier->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column  ">
                                                    <div class="d-flex align-items-center flex-wrap gap_5">
                                                        <h4 class="font_14 f_w_500 m-0 lh-base">{{__('shipping.tracking_id')}}
                                                            : </h4>
                                                        <p class="font_14 f_w_400 m-0 lh-base"> {{@$package->carrier_order_id }}</p>
                                                    </div>
                                                </div>
                                                @if(@$package->carrier->tracking_url)
                                                    <div class="d-flex flex-column  ">
                                                        <div class="d-flex align-items-center flex-wrap gap_5">
                                                            <h4 class="font_14 f_w_500 m-0 lh-base">{{__('shipping.tracking_url')}}
                                                                : </h4> <a
                                                                class="font_14 f_w_400 m-0 lh-base text_color"
                                                                target="_blank"
                                                                href="{{ str_replace("@",@$package->carrier_order_id,$package->carrier->tracking_url)}}"> {{__('common.click_here')}}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                                {{-- tracking end --}}
                            </div>
                        </div>
                    </div>
                    <!-- invoice print part end -->
                </div>
            </div>
        </div>
    </section>
    <!-- cancel order modal -->


    <div class="modal fade" id="orderCancelReasonModal" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        {{__('product.cancel_order')}}</h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('frontend.my_purchase_order_package_cancel')}}"
                      method="post">@csrf


                    <div class="row p-3">
                        <div class="col-lg-12 col-md-12 mt_20">
                            <div class="single_input ">
                                    <span class="primary_label2">{{ __('product.reason') }}  <span
                                            class=""> *</span> </span>
                                <select class="theme_select wide mb_20"
                                        name="reason" id="reason">
                                    @foreach ($cancel_reasons as $key => $cancel_reason)
                                        <option value="{{ $cancel_reason->id }}">{{ $cancel_reason->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" role="alert">{{$errors->first('language')}}</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="order_id" name="order_id" class="form-control order_id" required>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{__('common.Close')}}
                        </button>
                        <button type="submit"
                                class="link_value theme_btn small_btn4">{{__('product.send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


  </div>

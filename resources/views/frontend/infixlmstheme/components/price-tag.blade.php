<div class="price">
    @if(showEcommerce())
        <span class="prise_tag">
            <span class="current">
                @if((int)$discount!=0)
                    {{ getPriceFormat($discount) }}
                @else
                    {{ getPriceFormat($price) }}
                @endif

            </span>
            @if((int)$discount!=0)
                <del>
                    {{ getPriceFormat($price) }}
                </del>
            @endif
        </span>
    @endif
</div>

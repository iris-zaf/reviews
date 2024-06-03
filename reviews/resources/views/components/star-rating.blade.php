<div class="star-rating">
    @if($rating)
    @for($i = 1; $i <= 5; $i++) @if($i <=round($rating)) <span class="text-yellow-500">⭐</span> <!-- Filled star -->
        @else
        <span class="text-gray-400">✰</span> <!-- Empty star -->
        @endif
        @endfor
        @else
        <span>No rating yet</span>
        @endif
</div>
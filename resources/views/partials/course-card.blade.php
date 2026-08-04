<a href="{{ route('courses.show', $course) }}" class="group rounded-2xl bg-surface-850 border border-white/5 overflow-hidden hover:border-brand-500/40 hover:-translate-y-1 transition-all duration-300 flex flex-col">
    <div class="relative aspect-video overflow-hidden bg-surface-800">
        <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <span class="absolute top-3 left-3 text-xs font-semibold px-2.5 py-1 rounded-full bg-surface-950/80 backdrop-blur text-gray-300 border border-white/10 capitalize">{{ $course->level }}</span>
        @if($course->discount_price)
            <span class="absolute top-3 right-3 text-xs font-bold px-2.5 py-1 rounded-full bg-brand-600 text-white">SALE</span>
        @endif
    </div>
    <div class="p-5 flex flex-col flex-1">
        <span class="text-xs font-medium text-brand-400 mb-1">{{ $course->category->name }}</span>
        <h3 class="text-white font-semibold leading-snug mb-2 group-hover:text-brand-400 transition line-clamp-2">{{ $course->title }}</h3>
        <p class="text-xs text-gray-500 mb-4">By {{ $course->instructor_name }} &middot; {{ $course->duration_hours }}h</p>
        <div class="mt-auto flex items-center justify-between pt-3 border-t border-white/5">
            <div class="flex items-baseline gap-2">
                <span class="text-white font-bold">${{ number_format($course->displayPrice(), 2) }}</span>
                @if($course->discount_price)
                    <span class="text-xs text-gray-500 line-through">${{ number_format($course->price, 2) }}</span>
                @endif
            </div>
            <span class="text-xs font-semibold text-brand-400 group-hover:translate-x-0.5 transition-transform">View &rarr;</span>
        </div>
    </div>
</a>

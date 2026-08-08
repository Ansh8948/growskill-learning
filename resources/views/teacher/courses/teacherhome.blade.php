@extends('layouts.teacher')

@section('title', 'Add Course — Teacher Panel')

@section('content')

@if($errors->any())
    <div class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 mb-6">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form
    method="POST"
    action="{{ route('teacher.courses.store') }}"
    enctype="multipart/form-data"
    class="rounded-2xl bg-surface-850 border border-white/5 p-6 sm:p-8 space-y-5"
>

    @csrf

    {{-- Title --}}
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-1.5">
            Title
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
            required
            placeholder="Enter course title"
            class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
        >
    </div>


    {{-- Category + Level --}}
    <div class="grid sm:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">
                Category
            </label>

        
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">
                Level
            </label>

            <select
                name="level"
                required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500"
            >

                <option value="beginner"
                    @selected(old('level') === 'beginner')>
                    Beginner
                </option>

                <option value="intermediate"
                    @selected(old('level') === 'intermediate')>
                    Intermediate
                </option>

                <option value="advanced"
                    @selected(old('level') === 'advanced')>
                    Advanced
                </option>

            </select>
        </div>

    </div>


    {{-- Description --}}
    <div>

        <label class="block text-sm font-medium text-gray-400 mb-1.5">
            Description
        </label>

        <textarea
            name="description"
            rows="4"
            required
            placeholder="Describe your course..."
            class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
        >{{ old('description') }}</textarea>

    </div>


    {{-- Thumbnail Upload --}}
    <div>

        <label class="block text-sm font-medium text-gray-400 mb-1.5">
            Course Thumbnail
            <span class="text-gray-600">(optional)</span>
        </label>

        <input
            type="file"
            name="thumbnail"
            accept=".jpg,.jpeg,.png,.webp"
            class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
        >

        @error('thumbnail')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

        <p class="text-gray-600 text-xs mt-2">
            JPG, JPEG, PNG or WebP. Maximum 5MB.
        </p>

    </div>


    {{-- Video Upload --}}
    <div>

        <label class="block text-sm font-medium text-gray-400 mb-1.5">
            Course Video
        </label>

        <div class="rounded-xl border-2 border-dashed border-white/10 bg-surface-800 p-6">

            <div class="text-center">

                <div class="text-4xl mb-3">
                    🎥
                </div>

                <p class="text-white font-medium">
                    Upload Course Video
                </p>

                <p class="text-gray-600 text-xs mt-1 mb-4">
                    MP4, WebM or MOV — Maximum 500MB
                </p>

                <input
                    type="file"
                    name="video"
                    id="courseVideo"
                    accept=".mp4,.webm,.mov"
                    required
                    class="w-full text-sm text-gray-400
                           file:mr-4
                           file:py-2
                           file:px-4
                           file:rounded-lg
                           file:border-0
                           file:bg-brand-600
                           file:text-white
                           file:font-semibold
                           hover:file:bg-brand-500"
                >

            </div>

        </div>

        @error('video')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Video Preview --}}
    <div id="videoPreviewContainer" class="hidden">

        <label class="block text-sm font-medium text-gray-400 mb-2">
            Video Preview
        </label>

        <video
            id="videoPreview"
            controls
            class="w-full rounded-xl bg-black max-h-96"
        ></video>

        <p
            id="videoFileName"
            class="text-gray-500 text-xs mt-2"
        ></p>

    </div>


    {{-- Price --}}
    <div class="grid sm:grid-cols-2 gap-5">

        <div>

            <label class="block text-sm font-medium text-gray-400 mb-1.5">
                Price ($)
            </label>

            <input
                type="number"
                step="0.01"
                name="price"
                value="{{ old('price') }}"
                required
                min="0"
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
            >

        </div>


        <div>

            <label class="block text-sm font-medium text-gray-400 mb-1.5">
                Discount Price ($)
                <span class="text-gray-600">(optional)</span>
            </label>

            <input
                type="number"
                step="0.01"
                name="discount_price"
                value="{{ old('discount_price') }}"
                min="0"
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
            >

        </div>

    </div>


    {{-- Duration --}}
    <div>

        <label class="block text-sm font-medium text-gray-400 mb-1.5">
            Duration (hours)
        </label>

        <input
            type="number"
            name="duration_hours"
            value="{{ old('duration_hours') }}"
            required
            min="1"
            placeholder="Example: 10"
            class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
        >

    </div>


    {{-- Submit --}}
    <button
        type="submit"
        class="w-full sm:w-auto rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold px-8 py-3.5 transition shadow-lg shadow-brand-600/20"
    >
        Add Course
    </button>

</form>


{{-- Video Preview JavaScript --}}
<script>

    const videoInput = document.getElementById('courseVideo');

    const videoPreviewContainer =
        document.getElementById('videoPreviewContainer');

    const videoPreview =
        document.getElementById('videoPreview');

    const videoFileName =
        document.getElementById('videoFileName');


    videoInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {

            videoPreviewContainer.classList.add('hidden');

            videoPreview.removeAttribute('src');

            return;
        }


        // Check file size
        const maxSize = 500 * 1024 * 1024;

        if (file.size > maxSize) {

            alert('Video size must be less than 500MB.');

            this.value = '';

            videoPreviewContainer.classList.add('hidden');

            return;
        }


        // Show filename
        videoFileName.textContent =
            'Selected: ' + file.name;


        // Create preview
        const videoURL =
            URL.createObjectURL(file);

        videoPreview.src = videoURL;

        videoPreviewContainer.classList.remove('hidden');

    });

</script>

@endsection
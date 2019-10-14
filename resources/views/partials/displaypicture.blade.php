{{-- This display picture blade file takes two parameters: "user" and "size" --}}

@php
    if($size == 'sm') {
        $class="rounded-full h-8 w-8";
    }

    if($size == 'md') {
        $class="rounded-full h-12 w-12";
    }

    if($size == 'lg') {
        $class="rounded-full h-16 w-16";
    }

    if($size == 'xl') {
        $class="rounded-full h-20 w-20";
    }

    if ($user) {
        echo(sprintf(
            '<div class="%s" style="background-image: url(%s); background-size: cover;"></div>',
            $class,
            $user->getDisplayPictureUrl()
        ));
    }

@endphp

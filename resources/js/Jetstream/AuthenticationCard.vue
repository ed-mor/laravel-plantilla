<template>
	<div class="flex justify-center">
	    <div class="flex flex-col hidden md:inline-flex h-screen w-screen justify-center items-center pt-6 sm:pt-0 bg-green-900 text-white">
	        <div>
	            <h1 class="text-6xl">{{ $page.props.app_name }}</h1>
	            <h1 class="text-xl">{{ $page.props.app_slogan }}</h1>
	            <h1 class="text-sm mt-5">{{ $page.props.app_description }}</h1>
	        </div>
	    </div>
	    <div class="flex flex-col h-screen w-screen justify-center items-center pt-6 sm:pt-0 bg-gray-100">
	        <div>
	            <slot name="logo" />
	        </div>

	        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
	            <slot />
	        </div>
	    </div>
	</div>
</template>

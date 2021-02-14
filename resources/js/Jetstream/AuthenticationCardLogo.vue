<template>
    <inertia-link :href="'/'">
		<template>
			<div class="flex justify-around align-middle">
				<img class="mx-4" :src="$page.props.logo">
				<slot></slot>				
			</div>
		</template>
    </inertia-link>
</template>
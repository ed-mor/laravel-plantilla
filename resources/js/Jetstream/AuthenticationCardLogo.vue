<template>
    <inertia-link :href="'/'">
		<template>
			<img :src="logo">
		</template>
    </inertia-link>
</template>

<script>
	export default {
		data(){
			return{
				logo: 'http://localhost:8000/images/logo.png'
			}
		}
	}	
</script>
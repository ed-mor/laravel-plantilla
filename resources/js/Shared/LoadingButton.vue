<template>
  <button :disabled="loading" class="flex items-center">
    <div v-if="loading" class="btn-spinner mr-2" />
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    loading: Boolean,
  },
}
</script>
<style>
	.btn-spinner,
	.btn-spinner:after {
	  border-radius: 50%;
	  width: 1.5em;
	  height: 1.5em;
	}

	.btn-spinner {
	  font-size: 10px;
	  position: relative;
	  text-indent: -9999em;
	  border-top: .2em solid white;
	  border-right: .2em solid white;
	  border-bottom: .2em solid white;
	  border-left: .2em solid transparent;
	  transform: translateZ(0);
	  animation: spinning 1s infinite linear;
	}
</style>	

<template>
  <popper
    trigger="clickToToggle"
    :visible-arrow = "false"
    :options="{
      placement: 'bottom',
      modifiers: { offset: { offset: '0,10px' } },
      gpuAcceleration: true
    }"
    >

    <div class="popper">
      <slot></slot>
    </div>

    <button slot="reference">
        <div class="flex items-baseline">
          <span class="text-gray-700 hidden md:inline">Filtro</span>
          <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
            <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
          </svg>
        </div>
    </button>

  </popper>
</template>

<script>
// import Popper from 'popper.js'
import Popper from 'vue-popperjs';
import 'vue-popperjs/dist/vue-popper.css';

export default {
  props: {
    placement: {
      type: String,
      default: 'bottom-end',
    },
    boundary: {
      type: String,
      default: 'scrollParent',
    },
    autoClose: {
      type: Boolean,
      default: true,
    },
  },
  components: {
      'popper': Popper
  },
  data() {
    return {
      show: false,
    }
  },
  watch: {
    show(show) {
      } 
    },
  mounted() {
    //  Escuchando a la tecla Escape para ocultar el popper
    document.addEventListener('keydown', (e) => {
      if (e.keyCode === 27) {
        this.show = false
      }
    })
  },
}
</script>

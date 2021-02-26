<template>
	<div class="p-2">
      <!-- Usuario Actual -->    
      <div class="w-48 py-1 px-1 mx-16">
      	  <inertia-link href="/user/profile">
	          <img class="h-16 w-16 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />  	  	
      	  </inertia-link>
      </div>
      <div class="text-white text-lg mb-1 font-bold text-center w-52 border-b-2 border-gray-400 pb-1">
        {{$page.props.user.name}} 
  	  </div>
	  <div class="flex">
	    <div class="bg-red-900 flex flex-col justify-between w-48">
	      <div>
	        <ul class="text-white">
	          <!-- Usuarios -->
	          <li>
	            <a href="#" @click="toggleUsers=!toggleUsers" class="flex items-center p-3 hover:text-blue-500">
	              <div class="flex-1"> 
	                <i class="fas fa-users"></i>
	                <span class="hidden-item">&nbsp; Usuarios</span>
	              </div>
	              <i class="hidden-item fas" :class="{'fa-angle-right': toggleUsers, 'fa-angle-down': !toggleUsers }"></i>
	            </a>
	            <ul class="ml-4 hidden-item bg-green-900" :class="{'hidden': toggleUsers}">
	              <!-- Users/index.vue -->
	              <inertia-link href="/users">
		              <li class="border-b border-gray-800 block px-4 py-1 hover:text-blue-500">
	              		<i class="fas fa-list-ul"></i>
	              		&nbsp; Administrar
		              </li>
	              </inertia-link>
	              <li class="border-b border-gray-800">
	                <a href="#" class="block px-4 py-1 hover:text-blue-500">
	                	<i class="fas fa-plus-square"></i>
	                	&nbsp; Crear Usuario
	                </a>
	              </li>
	            </ul>
	          </li>
	          <!-- Roles y Permisos -->
	          <li>
	            <a href="#" @click="toggleRols=!toggleRols" class="flex items-center p-3 hover:text-blue-500">
	              <div class="flex-1">
	                <i class="fas fa-user-lock"></i>
	                <span class="hidden-item">&nbsp; Roles y Permisos</span>
	              </div>
	              <i class="hidden-item fas" :class="{'fa-angle-right': toggleRols, 'fa-angle-down': !toggleRols }"></i>
	            </a>
	            <ul class="ml-4 hidden-item bg-green-900" :class="{'hidden': toggleRols}">
	              <li class="border-b border-gray-800">
	                <a href="#" class="block px-4 py-1 hover:text-blue-500">
	                  	<i class="fas fa-dungeon"></i>
	                	&nbsp; Roles
	                </a>
	              </li>
	              <li class="border-b border-gray-800">
	                <a href="#" class="block px-4 py-1 hover:text-blue-500">
	                	<i class="fas fa-lock"></i>
	                  	&nbsp; Permisos
	                </a>
	              </li>
	            </ul>
	          </li>
	          <!-- Blog -->
	          <li>
	            <a href="#" @click="toggleBlog=!toggleBlog" class="flex items-center p-3 hover:text-blue-500">
	              <div class="flex-1">
	                <i class="fas fa-blog"></i>
	                <span class="hidden-item">&nbsp; Blog</span>
	              </div>
	              <i class="hidden-item fas" :class="{'fa-angle-right': toggleBlog, 'fa-angle-down': !toggleBlog }"></i>
	            </a>
	            <ul class="ml-4 hidden-item bg-green-900" :class="{'hidden': toggleBlog}">
	              <li class="border-b border-gray-800">
	                <a href="#" class="block px-4 py-1 hover:text-blue-500">
	                  	<i class="fas fa-list-ul"></i>
	                	&nbsp; Administrar
	                </a>
	              </li>
	              <li class="border-b border-gray-800">
	                <a href="#" class="block px-4 py-1 hover:text-blue-500">
	                	<i class="fas fa-plus-square"></i>
	                  	&nbsp; Crear
	                </a>
	              </li>
	            </ul>
	          </li>

	        </ul>
	      </div>
	    </div>
	  </div>
	</div>
</template>

<style>
  .is-close {
    text-align: center;
  }
  .is-close .hidden-item {
    display: none;
  }
</style>


<script>
	export default {
		data(){
			return {
				isClose: true,
				toggleUsers: true,
				toggleRols: true,
				toggleBlog: true,
			}
		}
	}
</script>
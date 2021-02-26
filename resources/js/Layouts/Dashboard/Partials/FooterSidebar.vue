<template>
    <div class="bg-blue-900 pb-16">
        <inertia-link :href="route('logout')" method="post">    
            <div class="font-extrabold uppercase text-white text-center p-2 hover:text-gray-400">
                <span class="item-center text-lg"> 
	                <i class="fas fa-power-off text-xl mr-3"></i>
	                cerrar sesión
                </span>                     
            </div>
        </inertia-link>
    </div>                             
</template>
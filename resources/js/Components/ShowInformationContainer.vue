<script setup>
</script>
<template>
    <div class="flex flex-col mt-6">
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-16 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <slot name="content" />
                </div>
            </div>
        </section>
    </div>
</template>
<script setup>
</script>

<template>
    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-2">
                    <div></div>
                    <div class="flex items-center space-x-2">
                        <slot name="filter" />
                        <slot name="download" />
                    </div>

                </div>

                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <slot name="table" />
                </div>
            </div>
        </div>

        <slot name="pagination" />
    </div>
</template>

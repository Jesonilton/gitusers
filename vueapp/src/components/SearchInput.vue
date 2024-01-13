<template>
    <div class="row d-flex justify-content-end pt-4">
        <div class="col-lg-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="term" placeholder="Pesquisar..." aria-label="Pesquisar" aria-describedby="basic-addon2">
            </div>
        </div>
    </div>
</template>

<script setup>
    import {defineModel} from 'vue'
    const term = defineModel()
</script>
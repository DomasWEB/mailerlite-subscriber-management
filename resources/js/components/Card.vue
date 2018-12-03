<template>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <slot name="title"></slot>
            </p>
            <div class="tools">
                <slot name="tools"></slot>
            </div>
        </header>
        <div class="card-content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Card"
    }
</script>

<style scoped>
    .tools {
        align-items: center;
        cursor: pointer;
        display: flex;
        justify-content: center;
        padding: .75rem
    }

    .card {
        border-radius: 5px;
    }
</style>
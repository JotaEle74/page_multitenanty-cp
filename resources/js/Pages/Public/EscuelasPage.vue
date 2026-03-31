<template>
    <EscuelaLayout :school="school" :slug="school.slug">
        hola
    </EscuelaLayout>
</template>
<script setup>
import EscuelaLayout from '@/Layouts/EscuelaLayout.vue';
const props = defineProps({
  school: {
    type: Object,
    default: () => ({})
  }
});
</script>
<script setup>
    import { onMounted, onBeforeUnmount, ref, watch } from 'vue';
    import { Chart } from 'chart.js/auto';

    const props = defineProps({
        data: { type: Object, required: true },
        title: { type: String, default: '' }
    });

    const canvas = ref(null);
    let chart = null;

    const renderChart = () => {
        if (chart) chart.destroy();

        chart = new Chart(canvas.value, {
            type: 'bar',
            data: {
                labels: Object.keys(props.data),
                datasets: [
                    {
                        label: props.title,
                        data: Object.values(props.data),
                        backgroundColor: [
                            '#8e44ad', // roxo
                            '#27ae60', // verde
                            '#f1c40f', // amarelo
                            '#e67e22', // laranja
                            '#95a5a6', // cinza
                        ],
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true },
                    title: {
                        display: true,
                        text: props.title
                    }
                }
            }
        });
    };

    onMounted(renderChart);
    onBeforeUnmount(() => chart?.destroy());
    watch(() => props.data, renderChart);
</script>

<template>
    <div>
        <canvas ref="canvas"></canvas>
    </div>
</template>


<style scoped>
    div
    {
        position: relative;
        height: 300px;
    }
</style>

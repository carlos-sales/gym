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
            type: 'pie',
            data: {
                labels: Object.keys(props.data),
                datasets: [
                    {
                        label: props.title,
                        data: Object.values(props.data),
                        backgroundColor: [
                            '#3498db',
                            '#e74c3c',
                        ],
                        hoverOffset: 8,
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

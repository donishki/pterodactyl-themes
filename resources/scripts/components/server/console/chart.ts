import {
    Chart as ChartJS,
    ChartData,
    ChartDataset,
    ChartOptions,
    Filler,
    LinearScale,
    LineElement,
    PointElement,
} from 'chart.js';
import { DeepPartial } from 'ts-essentials';
import { useState } from 'react';
import { deepmerge, deepmergeCustom } from 'deepmerge-ts';

ChartJS.register(LineElement, PointElement, Filler, LinearScale);

// Canvas cannot resolve CSS custom properties or Tailwind color functions.
// Convert the active palette to concrete colors before handing it to Chart.js.
export function getChartColors() {
    const style = typeof window === 'undefined' ? null : getComputedStyle(document.documentElement);
    const color = (role: string, fallback: string, alpha = 1) => {
        const channels = style?.getPropertyValue(`--theme-rgb-${role}`).trim().split(/\s+/).map(Number);
        return channels?.length === 3 && channels.every(Number.isFinite)
            ? `rgba(${channels.join(', ')}, ${alpha})`
            : fallback;
    };
    const light = style?.colorScheme === 'light';
    return {
        text: color('muted', '#cad1d8'),
        grid: color('text', 'rgba(202, 209, 216, 0.14)', 0.14),
        primary: color(light ? 'button' : 'accent', '#22d3ee'),
        primaryFill: color(light ? 'button' : 'accent', 'rgba(34, 211, 238, 0.14)', 0.14),
        secondary: light ? '#975a16' : '#fbbf24',
        secondaryFill: light ? 'rgba(151, 90, 22, 0.12)' : 'rgba(251, 191, 36, 0.12)',
        font: style?.getPropertyValue('--theme-font').trim() || '"IBM Plex Sans", sans-serif',
    };
}

const options: ChartOptions<'line'> = {
    responsive: true,
    animation: false,
    plugins: {
        legend: { display: false },
        title: { display: false },
        tooltip: { enabled: false },
    },
    layout: {
        padding: 0,
    },
    scales: {
        x: {
            min: 0,
            max: 19,
            type: 'linear',
            grid: {
                display: false,
                drawBorder: false,
            },
            ticks: {
                display: false,
            },
        },
        y: {
            min: 0,
            type: 'linear',
            grid: {
                display: true,
                color: 'rgba(202, 209, 216, 0.14)',
                drawBorder: false,
            },
            ticks: {
                display: true,
                count: 3,
                color: '#cad1d8',
                font: {
                    family: 'sans-serif',
                    size: 11,
                    weight: '400',
                },
            },
        },
    },
    elements: {
        point: {
            radius: 0,
        },
        line: {
            tension: 0.15,
        },
    },
};

function getOptions(opts?: DeepPartial<ChartOptions<'line'>> | undefined): ChartOptions<'line'> {
    const colors = getChartColors();
    return deepmerge(options, {
        scales: { y: { grid: { color: colors.grid }, ticks: { color: colors.text, font: { family: colors.font } } } },
    }, opts || {});
}

type ChartDatasetCallback = (value: ChartDataset<'line'>, index: number) => ChartDataset<'line'>;

function getEmptyData(label: string, sets = 1, callback?: ChartDatasetCallback | undefined): ChartData<'line'> {
    const colors = getChartColors();
    const next = callback || ((value) => value);

    return {
        labels: Array(20)
            .fill(0)
            .map((_, index) => index),
        datasets: Array(sets)
            .fill(0)
            .map((_, index) =>
                next(
                    {
                        fill: true,
                        label,
                        data: Array(20).fill(null),
                        borderColor: colors.primary,
                        borderWidth: 2,
                        backgroundColor: colors.primaryFill,
                    },
                    index
                )
            ),
    };
}

const merge = deepmergeCustom({ mergeArrays: false });

interface UseChartOptions {
    sets: number;
    options?: DeepPartial<ChartOptions<'line'>> | number | undefined;
    callback?: ChartDatasetCallback | undefined;
}

function useChart(label: string, opts?: UseChartOptions) {
    const options = getOptions(
        typeof opts?.options === 'number' ? { scales: { y: { min: 0, suggestedMax: opts.options } } } : opts?.options
    );
    const [data, setData] = useState(getEmptyData(label, opts?.sets || 1, opts?.callback));

    const push = (items: number | null | (number | null)[]) =>
        setData((state) =>
            merge(state, {
                datasets: (Array.isArray(items) ? items : [items]).map((item, index) => ({
                    ...state.datasets[index],
                    data: state.datasets[index].data
                        .slice(1)
                        .concat(typeof item === 'number' ? Number(item.toFixed(2)) : item),
                })),
            })
        );

    const clear = () =>
        setData((state) =>
            merge(state, {
                datasets: state.datasets.map((value) => ({
                    ...value,
                    data: Array(20).fill(null),
                })),
            })
        );

    return { props: { data, options }, push, clear };
}

function useChartTickLabel(label: string, max: number, tickLabel: string, roundTo?: number) {
    return useChart(label, {
        sets: 1,
        options: {
            scales: {
                y: {
                    suggestedMax: max,
                    ticks: {
                        callback(value) {
                            return `${roundTo ? Number(value).toFixed(roundTo) : value}${tickLabel}`;
                        },
                    },
                },
            },
        },
    });
}

export { useChart, useChartTickLabel, getOptions, getEmptyData };

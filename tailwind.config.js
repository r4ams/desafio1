import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
    ],
    theme: {
        colors: {
            ...colors,
            bmBlue:{
                DEFAULT: '#0047BB',
                100: '#CAD4E8',
                200: '#9FB1D6',
                300: '#8A9FCC',
                400: '#4A6BB1',
                500: '#224182',
                600: '#193162',
                700: '#112041',
            },
            bmCyan:{
                DEFAULT: '#1C9AD6',
                50: '#F0F9FD',
                100: '#E8F5FB',
                200: '#B0DCF1',
                300: '#55B3E0',
                400: '#198BC1',
                500: '#146C96',
                600: '#115C80',
                700: '#0B3E56',
            },
            bmGrey:{
                DEFAULT: '#7B868C',
                100: '#EBEDEE',
                200: '#D1D5D7',
                300: '#B0B6BA',
                400: '#959EA3',
                500: '#5C6569',
                600: '#444A4D',
                700: '#313638',
            },
            bmAqua:{
                DEFAULT: '#119099',
                100: '#DBEEF0',
                200: '#ACD8DB',
                300: '#64B7BD',
                400: '#35A1A8',
                500: '#0B5E63',
                600: '#09484D',
                700: '#073A3D',
            },
            bmBlue2:{
                DEFAULT: '#1B5B77',
                100: '#DDE6EB',
                200: '#A4BDC9',
                300: '#497C92',
                400: '#174D65',
                500: '#134053',
                600: '#0F3241',
                700: '#0B2430',
            },
            bmPurple:{
                DEFAULT: '#7483C4',
                100: '#E3E6F3',
                200: '#C0C7E4',
                300: '#9EA8D6',
                400: '#828FCA',
                500: '#576293',
                600: '#40486C',
                700: '#343B58',
            },
            success:{
                DEFAULT: '#4CAF50',
                100: '#DBEFDC',
                200: '#AEDBB0',
                300: '#8BCB8D',
                400: '#5EB762',
                500: '#3D8C40',
                600: '#2E6930',
                700: '#1E4620',
            },
            danger:{
                DEFAULT: '#F44336',
                100: '#FEECEB',
                200: '#FCC7C3',
                300: '#F8857C',
                400: '#F65F54',
                500: '#C3362B',
                600: '#86251E',
                700: '#621B16',
            },
            warning:{
                DEFAULT: '#FF9800',
                100: '#FFE5BF',
                200: '#FFC166',
                300: '#FFAD33',
                400: '#D98100',
                500: '#B36A00',
                600: '#8C5400',
                700: '#593500',
            },
            info:{
                DEFAULT: '#2196F3',
                100: '#C8E5FC',
                200: '#7AC0F8',
                300: '#4DABF5',
                400: '#1C80CF',
                500: '#15629E',
                600: '#114B7A',
                700: '#08263D',
            },
            grey: '#EEEEEE',
            white: '#FFFFFF',
            overlay: "#36363665",
            "vtd-primary": colors.sky, // Light mode Datepicker color
            purple: '#FF9800',
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require ('flowbite/plugin.js')],
};

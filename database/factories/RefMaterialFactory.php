<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefMaterial>
 */
class RefMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar material
        $components = [
            'Resistor',
            'Capacitor',
            'Inductor',
            'Diode',
            'Transistor',
            'Integrated Circuit (IC)',
            'Light Emitting Diode (LED)',
            'Zener Diode',
            'Thyristor',
            'Photodiode',
            'Crystal Oscillator',
            'Relay',
            'Potentiometer',
            'Varistor',
            'Thermistor',
            'Fuse',
            'Push Button Switch',
            'Toggle Switch',
            'Rotary Switch',
            'Connector',
            'Piezoelectric Buzzer',
            'Voltage Regulator',
            'Operational Amplifier (Op-Amp)',
            'Microcontroller',
            'Battery',
            'Power Supply Unit (PSU)',
            'Printed Circuit Board (PCB)',
            'Hall Effect Sensor',
            'Current Transformer',
            'Resonator',
            'Photoresistor',
            'Optocoupler',
            'NPN Transistor',
            'PNP Transistor',
            'SCR (Silicon Controlled Rectifier)',
            'IGBT (Insulated Gate Bipolar Transistor)',
            'MOSFET (Metal-Oxide-Semiconductor Field-Effect Transistor)',
            'Schottky Diode',
            'Bridge Rectifier',
            'Inductive Proximity Sensor',
            'Capacitive Proximity Sensor',
            'Bipolar Junction Transistor (BJT)',
            'Junction Field Effect Transistor (JFET)',
            'EEPROM',
            'Flash Memory',
            'Crystal Filter',
            'LC Filter',
            'SAW Filter (Surface Acoustic Wave)',
            'Tantalum Capacitor',
            'Electrolytic Capacitor',
        ];

        return [
            'material' => $this->faker->randomElement($components),  // Dummy data untuk nama material
            'kode' => $this->faker->unique()->bothify('MAT###'), // Kode material unik
        ];
    }
}

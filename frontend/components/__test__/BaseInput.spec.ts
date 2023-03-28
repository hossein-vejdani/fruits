import { mount } from '@vue/test-utils'
import { describe, it, expect, vi } from 'vitest'
import BaseInput, { Props } from '../BaseInput.vue'

vi.mock('~~/composables/useModelValue', async () => {
    const actual = (await vi.importActual('~~/composables/useModelValue')) as any
    return {
        ...actual
    }
})

describe('BaseInput', () => {
    const propsData: Props = {
        label: 'Test Input Label',
        modelValue: 'initial value',
        debounce: 0
    }

    it('renders label and input with initial value', () => {
        const wrapper = mount(BaseInput, {
            propsData
        })

        expect(wrapper.find('label').text()).toBe(propsData.label)
        expect(wrapper.find('input').element.value).toBe(propsData.modelValue)
    })

    it('emits update:modelValue event on input change', async () => {
        const wrapper = mount(BaseInput, {
            propsData
        })

        const input = wrapper.find('input')
        const newValue = 'new value'

        await input.setValue(newValue)
        await wrapper.vm.$nextTick()

        expect(wrapper.emitted('update:modelValue')).toBeTruthy()
        expect(wrapper.emitted('update:modelValue')?.[0]).toEqual([newValue])
    })
})

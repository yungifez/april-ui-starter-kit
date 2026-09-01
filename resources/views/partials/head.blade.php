<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<script>
    (() => {
        const stored = localStorage.getItem('appearance') || localStorage.getItem('theme') || document.cookie.match(/(?:^|;\s*)appearance=(light|dark|system)(?:;|$)/)?.[1] || 'system'
        const dark = stored === 'dark' || (stored === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)

        document.documentElement.classList.toggle('dark', dark)
        document.documentElement.style.colorScheme = dark ? 'dark' : 'light'
    })()
</script>

@fonts

@aprilStyles
@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    (() => {
        const appearanceKey = 'appearance'
        const legacyThemeKey = 'theme'
        const appearances = ['light', 'dark', 'system']
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')

        const validAppearance = (value) => appearances.includes(value) ? value : null
        const getStoredAppearance = () => validAppearance(
            localStorage.getItem(appearanceKey) || localStorage.getItem(legacyThemeKey)
        )
        const updateTheme = (value) => {
            const dark = value === 'dark' || (value === 'system' && mediaQuery.matches)

            document.documentElement.classList.toggle('dark', dark)
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light'
        }
        const setCookie = (value) => {
            document.cookie = `${appearanceKey}=${value};path=/;max-age=${365 * 24 * 60 * 60};SameSite=Lax`
        }
        const syncControls = () => {
            const currentAppearance = getStoredAppearance() || 'system'
            const selectedClasses = 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'.split(' ')
            const idleClasses = 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60'.split(' ')

            document.querySelectorAll('[data-appearance-control]').forEach((control) => {
                const selected = control.dataset.appearanceControl === currentAppearance

                control.classList.remove(...selectedClasses, ...idleClasses)
                control.classList.add(...(selected ? selectedClasses : idleClasses))
                control.setAttribute('aria-pressed', selected ? 'true' : 'false')
            })
        }
        const updateAppearance = (value) => {
            const appearance = validAppearance(value) || 'system'

            localStorage.setItem(appearanceKey, appearance)
            localStorage.removeItem(legacyThemeKey)
            setCookie(appearance)
            updateTheme(appearance)
            syncControls()
        }
        const handleSystemThemeChange = () => updateTheme(getStoredAppearance() || 'system')
        const handleLivewireNavigation = () => {
            updateTheme(getStoredAppearance() || 'system')
            syncControls()
        }

        if (!localStorage.getItem(appearanceKey) && getStoredAppearance()) {
            localStorage.setItem(appearanceKey, getStoredAppearance())
        }

        window.aprilAppearance = { getStoredAppearance, updateAppearance, updateTheme }
        updateTheme(getStoredAppearance() || 'system')
        mediaQuery.addEventListener('change', handleSystemThemeChange)
        document.addEventListener('click', (event) => {
            const control = event.target.closest('[data-appearance-control]')

            if (control) {
                updateAppearance(control.dataset.appearanceControl)
            }
        })
        document.addEventListener('DOMContentLoaded', syncControls)
        document.addEventListener('livewire:navigated', handleLivewireNavigation)
    })()
</script>

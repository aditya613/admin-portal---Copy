@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3.5 border-2 border-blue-200/60 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 rounded-xl shadow-sm bg-white/90 backdrop-blur-sm transition-all duration-300 placeholder:text-blue-400/60 text-blue-900 font-medium focus:shadow-lg focus:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed']) }}>

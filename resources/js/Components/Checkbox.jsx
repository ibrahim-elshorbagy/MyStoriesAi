export default function Checkbox({ className = '', ...props }) {
    return (
        <input
            {...props}
            type="checkbox"
            className={
                'rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500 dark:border-neutral-700 dark:bg-neutral-900 dark:focus:ring-orange-600 dark:focus:ring-offset-neutral-800 ' +
                className
            }
        />
    );
}

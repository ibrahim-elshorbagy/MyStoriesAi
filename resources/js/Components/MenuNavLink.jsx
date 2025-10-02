import { Link } from '@inertiajs/react';

export default function MenuNavLink({
  active = false,
  className = '',
  icon = '',
  children,
  onClick,
  href,
  ...props
}) {
  const baseClasses = `
  flex items-center gap-3 px-5 py-3  text-base font-medium transition-colors duration-200
  w-full
  ${active
      ? 'bg-orange-100 text-orange-700 '
      : 'text-neutral-700  hover:bg-neutral-100 hover:text-orange-600 '
    }
  ${className}
`;

  // If onClick is provided and href starts with #, render as button
  if (onClick && href && href.startsWith('#')) {
    return (
      <button
        onClick={onClick}
        className={baseClasses}
        {...props}
      >
        {icon && <i className={`fa-solid ${icon} w-5 text-center`}></i>}
        <span>{children}</span>
      </button>
    );
  }

  // Default Link behavior
  return (
    <Link
      href={href}
      onClick={onClick}
      className={baseClasses}
      {...props}
    >
      {icon && <i className={`fa-solid ${icon} w-5 text-center`}></i>}
      <span>{children}</span>
    </Link>
  );
}

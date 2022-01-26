
const MULTIPLIERS = {
	seconds: 1000,
	minutes: 1000*60,
	hours:   1000*60*60,
	days:    1000*60*60*24,
}

/**
 * Take the difference between the dates and divide by milliseconds per day.
 * @param {Date} first
 * @param {Date} second
 * @param {string} interval
 */
export const dateDiff = (first, second, interval='days') => {
	const multiplier = MULTIPLIERS[ interval ] || 1;

	return Math.round((second-first)/(multiplier));
}

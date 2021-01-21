export default (value) => {
    const date= new Date(value)
    return date.toLocaleString(['en-US','ar-SA'], {
        month: 'short', day: '2-digit', year: 'numeric'
    })
}
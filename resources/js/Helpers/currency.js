export const formatCurrency = (mount) => {
    
    return (mount/100).toLocaleString({
        style: 'currency',
        currency: 'USD'
    })

} 
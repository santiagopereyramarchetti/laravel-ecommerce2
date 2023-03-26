export const formatCurrency = (mount) => {
    
    return (mount/100).toLocaleString("en-US", {
        style: 'currency',
        currency: 'USD'
    })

} 